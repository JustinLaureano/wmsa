import React, { useContext, useEffect, useMemo, useState } from 'react';
import MessagingContext from '@/Contexts/MessagingContext';
import MessagingService from '@/Services/MessagingService';
import AuthContext from '@/Contexts/AuthContext';
import { ConversationResource, MessageResource, NewMessageRequestData } from '@/types/messaging';

interface MessagingProviderProps {
    children: React.ReactNode;
}

export default function MessagingProvider({ children, ...props }: MessagingProviderProps) {
    const { teammate, user } = useContext(AuthContext);
    const messagingService = new MessagingService();

    const [conversations, setConversations] = useState<ConversationResource[]>([]);
    const [unreadMessages, setUnreadMessages] = useState(0);
    
    const [activeConversation, setActiveConversation] = useState<ConversationResource | null>(null);
    const [activeMessages, setActiveMessages] = useState<MessageResource[] | null>(null);

    const fetchConversations = async () => {
        let participant_id, participant_type = '';

        if (teammate) {
            participant_id = teammate.clock_number;
            participant_type = 'teammate';
        }
        else if (user) {
            participant_id = user.guid;
            participant_type = 'user';
        }

        if ( !participant_id ) return;

        const response = await messagingService.getConversations(participant_id, participant_type);

        setConversations(response.data);
        setUnreadMessages(response.computed.unread_messages);
    };

    const fetchConversationMessages = async () => {
        if ( !activeConversation ) {
            setActiveMessages(null);
            return;
        }

        const response = await messagingService.getConversationMessages(activeConversation.uuid);

        setActiveMessages(response.data);
    }

    const handleNewMessageRequest = async (content: string) => {
        let sender_id, sender_type = '';

        if (teammate) {
            sender_id = teammate.clock_number.toString();
            sender_type = 'teammate';
        }
        else if (user) {
            sender_id = user.guid;
            sender_type = 'user';
        }

        if ( !sender_id || !activeConversation ) return;

        const data : NewMessageRequestData = {
            conversation_uuid: activeConversation.uuid,
            sender_id,
            sender_type,
            content
        };

        const message : MessageResource | null = await messagingService.createMessage(data);

        if (message) {
            setActiveMessages((prevMessages) => {
                if (!prevMessages) return [message];
    
                return [...prevMessages, message];
            })
        }

        return message;
    }

    useEffect(() => {
        fetchConversations();
    }, [])

    useEffect(() => {
        fetchConversationMessages();
    }, [activeConversation])

    const defaultValue = {
        conversations,
        setConversations,
        unreadMessages,
        setUnreadMessages,
        activeConversation,
        setActiveConversation,
        activeMessages,
        setActiveMessages,
        handleNewMessageRequest
    };

    const dependencies = [
        conversations,
        unreadMessages,
        activeConversation,
        activeMessages
    ];

    const value = useMemo(() => defaultValue, dependencies)

    return (
        <MessagingContext.Provider value={value}>
            {children}
        </MessagingContext.Provider>
    );
}
