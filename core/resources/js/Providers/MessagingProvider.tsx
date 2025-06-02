import { useContext, useEffect, useMemo, useState } from 'react';
import {
    MessagingProviderProps,
    ConversationResource,
    MessageResource,
    MessageFormData,
    MessagingContextValue,
} from '@/types';
import MessagingContext from '@/Contexts/MessagingContext';
import { MessageCreationService, ConversationService } from '@/Services/Messaging';
import AuthContext from '@/Contexts/AuthContext';
import { getPrimaryAuthIdentifiers } from '@/Utils/auth';

export default function MessagingProvider({ children }: MessagingProviderProps) {
    const { teammate, user } = useContext(AuthContext);
    const messageService = new MessageCreationService();
    const conversationService = new ConversationService();

    const [conversations, setConversations] = useState<ConversationResource[]>([]);
    const [unreadMessages, setUnreadMessages] = useState(0);
    const [activeConversation, setActiveConversation] = useState<ConversationResource | null>(null);
    const [activeMessages, setActiveMessages] = useState<MessageResource[] | null>(null);

    const fetchConversations = async () => {
        const { id: participant_id, type: participant_type } = getPrimaryAuthIdentifiers(teammate, user);

        if (!participant_id) {
            setConversations([]);
            setUnreadMessages(0);
            return;
        }

        const response = await conversationService.getConversations(participant_id, participant_type);
        setConversations(response.data.data);
        setUnreadMessages(response.data.computed.unread_messages);
    };

    const fetchConversationMessages = async () => {
        if (!activeConversation) {
            setActiveMessages(null);
            return;
        }

        // TODO: Implement loading state
        const messages = await conversationService.getConversationMessages(activeConversation.uuid);
        setActiveMessages(messages);
    };

    const handleNewMessageRequest = async (content: string) => {
        const { id: sender_id, type: sender_type } = getPrimaryAuthIdentifiers(teammate, user);

        if (!sender_id || !activeConversation) return null;

        const data: MessageFormData = {
            conversation_uuid: activeConversation.uuid,
            sender_id,
            sender_type,
            content,
        };

        const message = await messageService.createMessage(data);

        if (message) {
            setActiveMessages((prevMessages) => [...(prevMessages || []), message]);
        }

        return message;
    };

    const handleMessageSent = (e: { message: MessageResource }) => {
        // Simplify: Always refresh both, as message affects conversations and messages
        fetchConversationMessages();
        fetchConversations();
    };

    useEffect(() => {
        fetchConversations();
    }, [user?.guid]);

    useEffect(() => {
        fetchConversationMessages();
    }, [activeConversation]);

    useEffect(() => {
        if (user?.guid) {
            window.Echo.private(`conversation.user.${user.guid}`).listen(
                '.message.sent',
                handleMessageSent
            );
        }

        return () => {
            if (user?.guid) window.Echo.leave(`conversation.user.${user.guid}`);
        };
    }, [user?.guid]);

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
    };

    const value = useMemo(() => defaultValue, [
        conversations,
        unreadMessages,
        activeConversation,
        activeMessages,
    ]);

    return <MessagingContext.Provider value={value}>{children}</MessagingContext.Provider>;
}