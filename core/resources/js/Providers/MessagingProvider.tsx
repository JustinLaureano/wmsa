import React, { useEffect, useMemo, useState } from 'react';
import MessagingContext, { Conversation } from '@/Contexts/MessagingContext';
import MessagingService from '@/Services/MessagingService';

interface MessagingProviderProps {
    children: React.ReactNode;
}

export default function MessagingProvider({ children, ...props }: MessagingProviderProps) {
    const [conversations, setConversations] = useState<Conversation[]>([]);

    const defaultValue = {
        conversations,
        setConversations
    };

    const dependencies = [conversations];

    const value = useMemo(() => defaultValue, dependencies)

    const fetchConversations = async () => {
        const response = await new MessagingService().getConversations();

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
