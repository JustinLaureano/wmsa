import { useEffect, useMemo, useState } from "react";
import {
    ConversationFormData,
    ConversationResource,
    MessageResource,
    MessagingProviderProps,
    MessagingContextValue,
    ParticipantAutocompleteResource,
} from "@/types";
import MessagingContext from "@/Contexts/MessagingContext";
import {
    MessageCreationService,
    ConversationService,
    MessageStatusService,
    ConversationCreationService,
    ParticipantOptionService,
} from "@/Services/Messaging";
import { useAuth } from '@/Providers/AuthProvider';

export default function MessagingProvider({ children }: MessagingProviderProps) {
    const { user } = useAuth();
    const messageService = new MessageCreationService();
    const messageStatusService = new MessageStatusService();
    const conversationService = new ConversationService();
    const conversationCreationService = new ConversationCreationService();
    const participantOptionService = new ParticipantOptionService();

    const [conversations, setConversations] = useState<ConversationResource[]>([]);
    const [unreadMessages, setUnreadMessages] = useState(0);
    const [activeConversation, setActiveConversation] = useState<ConversationResource | null>(null);
    const [activeMessages, setActiveMessages] = useState<MessageResource[] | null>(null);
    const [isLoadingMessages, setIsLoadingMessages] = useState(false);
    const [isStartingNewConversation, setIsStartingNewConversation] = useState(false);
    const [newConversationParticipants, setNewConversationParticipants] = useState<string[]>([]);
    const [participantOptions, setParticipantOptions] = useState<ParticipantAutocompleteResource[]>([]);

    const fetchConversations = async () => {
        if (!user?.uuid) {
            setConversations([]);
            setUnreadMessages(0);
            return;
        }

        const response = await conversationService.getConversations();

        setConversations(response.data);
        setUnreadMessages(response.computed.unread_messages);
    };

    const fetchConversationMessages = async () => {
        if (!activeConversation) {
            setActiveMessages(null);
            return;
        }

        setIsLoadingMessages(true);
        try {
            const messages = await conversationService.getConversationMessages(activeConversation.uuid);

            setActiveMessages(messages);
        }
        finally {
            setIsLoadingMessages(false);
        }
    };

    const handleNewMessageRequest = async (content: string) => {
        if (!user?.uuid || !activeConversation) return null;

        const data = {
            conversation_uuid: activeConversation.uuid,
            user_uuid: user.uuid,
            content,
        };

        const message = await messageService.createMessage(data);

        if (message) {
            setActiveMessages((prevMessages) => [...(prevMessages || []), message]);
        }

        return message;
    };

    const handleMessageSent = (e: { message: MessageResource }) => {
        // Refresh conversations and messages
        fetchConversations();
        setTimeout(() => {
            fetchConversationMessages();
        }, 150);
    };

    const handleConversationMessagesRead = async (conversationUuid: string, userUuid: string) => {
        const response = await messageStatusService.markMessagesAsRead(conversationUuid, userUuid);

        fetchConversations();
    }

    const handleStartNewConversation = (participants: string[]) => {
        setNewConversationParticipants(participants);
        setActiveConversation(null);
        setActiveMessages(null);
        setIsStartingNewConversation(true);
    };

    const handleAddNewConversationParticipant = (participant: string) => {
        setNewConversationParticipants((prevParticipants) => [...prevParticipants, participant]);
    };

    const handleRemoveNewConversationParticipant = (participant: string) => {
        setNewConversationParticipants((prevParticipants) => prevParticipants.filter(p => p !== participant));
    };

    const handleCreateNewConversation = async (content: string) => {
        if (!user?.uuid || newConversationParticipants.length === 0) return;

        const data: ConversationFormData = {
            user_uuid: user.uuid,
            participants: newConversationParticipants,
            content,
            group_conversation: false,
        };

        const conversation = await conversationCreationService.createConversation(data);

        if (conversation) {
            setConversations((prevConversations) => [conversation, ...prevConversations]);
            setActiveConversation(conversation);
            setNewConversationParticipants([]);
            setIsStartingNewConversation(false);
        }
    };

    const fetchParticipantOptions = async () => {
        if (!user?.uuid) return;

        const options = await participantOptionService.getParticipantOptions();
        setParticipantOptions(options || []);
    };

    const conversationExists = () => {
        if (!user?.uuid) return false;

        const existingConversation = conversations.find(conversation => {
            const participants = conversation.relations.participants.data;
            const expectedParticipantCount = newConversationParticipants.length + 1; // +1 for current user

            if (participants.length !== expectedParticipantCount) {
                return false;
            }

            const participantUuids = participants.map(p => p.user_uuid);
            const expectedUuids = [...newConversationParticipants, user.uuid];

            return expectedUuids.every(uuid => participantUuids.includes(uuid));
        });

        return existingConversation ? existingConversation : false;
    }

    useEffect(() => {
        fetchConversations();
    }, [user?.uuid]);

    useEffect(() => {
        if (!activeConversation) {
            setIsStartingNewConversation(true);
        }
        else {
            setIsStartingNewConversation(false);
            if (activeConversation && (!activeMessages || activeMessages[0]?.attributes.conversation_uuid !== activeConversation.uuid)) {
                fetchConversationMessages();
            }
        }

    }, [activeConversation]);

    useEffect(() => {
        if (activeMessages) {
            const conversationUuid = activeMessages[0]?.attributes.conversation_uuid;
        if (conversationUuid && activeConversation?.uuid !== conversationUuid) {
            const matchingConversation = conversations.find(conv => conv.uuid === conversationUuid);
            if (matchingConversation) {
                    setActiveConversation(matchingConversation);
                }
            }
        }
    }, [activeMessages]);

    useEffect(() => {
        if (user?.uuid) {
            window.Echo.private(`conversation.user.${user.uuid}`).listen(
                ".message.sent",
                handleMessageSent
            );
        }

        return () => {
            if (user?.uuid) {
                window.Echo.leave(`conversation.user.${user.uuid}`);
            }
        };
    }, [user?.uuid]);

    useEffect(() => {
        fetchParticipantOptions();
    }, []);

    const defaultValue: MessagingContextValue = {
        conversations,
        setConversations,
        unreadMessages,
        setUnreadMessages,
        activeConversation,
        setActiveConversation,
        activeMessages,
        setActiveMessages,
        handleNewMessageRequest,
        handleConversationMessagesRead,
        isLoadingMessages,
        isStartingNewConversation,
        setIsStartingNewConversation,
        newConversationParticipants,
        setNewConversationParticipants,
        handleStartNewConversation,
        handleAddNewConversationParticipant,
        handleRemoveNewConversationParticipant,
        handleCreateNewConversation,
        participantOptions,
        conversationExists,
    };

    const value = useMemo(() => defaultValue, [
        conversations,
        unreadMessages,
        activeConversation,
        activeMessages,
        isLoadingMessages,
        isStartingNewConversation,
        newConversationParticipants,
        participantOptions,
    ]);

    return <MessagingContext.Provider value={value}>{children}</MessagingContext.Provider>;
}