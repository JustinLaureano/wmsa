import { useContext, useEffect, useMemo, useState } from "react";
import {
    MessagingProviderProps,
    ConversationResource,
    MessageResource,
    MessagingContextValue,
} from "@/types";
import MessagingContext from "@/Contexts/MessagingContext";
import { MessageCreationService, ConversationService } from "@/Services/Messaging";
import AuthContext from "@/Contexts/AuthContext";

export default function MessagingProvider({ children }: MessagingProviderProps) {
    const { user } = useContext(AuthContext);
    const messageService = new MessageCreationService();
    const conversationService = new ConversationService();

    const [conversations, setConversations] = useState<ConversationResource[]>([]);
    const [unreadMessages, setUnreadMessages] = useState(0);
    const [activeConversation, setActiveConversation] = useState<ConversationResource | null>(null);
    const [activeMessages, setActiveMessages] = useState<MessageResource[] | null>(null);
    const [isLoadingMessages, setIsLoadingMessages] = useState(false);

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
        } finally {
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
        fetchConversationMessages();
    };

    useEffect(() => {
        fetchConversations();
    }, [user?.uuid]);

    useEffect(() => {
        fetchConversationMessages();
    }, [activeConversation?.uuid]);

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
        isLoadingMessages,
    };

    const value = useMemo(() => defaultValue, [
        conversations,
        unreadMessages,
        activeConversation,
        activeMessages,
        isLoadingMessages,
    ]);

    return <MessagingContext.Provider value={value}>{children}</MessagingContext.Provider>;
}