import React, { useContext, useEffect, useMemo, useState } from 'react';
import MessagingContext, { Conversation } from '@/Contexts/MessagingContext';
import MessagingService from '@/Services/MessagingService';
import AuthContext from '@/Contexts/AuthContext';

interface MessagingProviderProps {
    children: React.ReactNode;
}

export default function MessagingProvider({ children, ...props }: MessagingProviderProps) {
    const { teammate, user } = useContext(AuthContext);

    const [conversations, setConversations] = useState<Conversation[]>([]);

    const defaultValue = {
        conversations,
        setConversations
    };

    const dependencies = [conversations];

    const value = useMemo(() => defaultValue, dependencies)

    const fetchConversations = async () => {
        let participant_id, participant_type = '';

        if (teammate) {
            participant_id = teammate.clock_number;
            participant_type = 'teammate';
        }
        else if (user) {
            participant_id = user.uuid;
            participant_type = 'user';
        }

        if ( !participant_id ) return;

        const response = await new MessagingService().getConversations(participant_id, participant_type);
        console.log(response);
        
    };

    useEffect(() => {
        fetchConversations();
    }, [])

    return (
        <MessagingContext.Provider value={value}>
            {children}
        </MessagingContext.Provider>
    );
}
