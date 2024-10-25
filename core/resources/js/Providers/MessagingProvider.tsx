import React, { useContext, useEffect, useMemo, useState } from 'react';
import MessagingContext from '@/Contexts/MessagingContext';
import MessagingService from '@/Services/MessagingService';
import AuthContext from '@/Contexts/AuthContext';
import { ConversationResource } from '@/types/messaging';

interface MessagingProviderProps {
    children: React.ReactNode;
}

export default function MessagingProvider({ children, ...props }: MessagingProviderProps) {
    const { teammate, user } = useContext(AuthContext);

    const [conversations, setConversations] = useState<ConversationResource[]>([]);
    const [unreadMessages, setUnreadMessages] = useState(0);
    
    const [activeConversation, setActiveConversation] = useState<ConversationResource | null>(null);

    const defaultValue = {
        conversations,
        setConversations,
        unreadMessages,
        setUnreadMessages,
        activeConversation,
        setActiveConversation
    };

    const dependencies = [conversations, unreadMessages, activeConversation];

    const value = useMemo(() => defaultValue, dependencies)

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

        const response = await new MessagingService().getConversations(participant_id, participant_type);
        console.log(response)
        setConversations(response.data)
        setUnreadMessages(response.computed.unread_messages)
    };

    useEffect(() => {
        fetchConversations();
    }, [])

    useEffect(() => {
        // TODO: load messages for active conversation
    }, [activeConversation])

    return (
        <MessagingContext.Provider value={value}>
            {children}
        </MessagingContext.Provider>
    );
}
