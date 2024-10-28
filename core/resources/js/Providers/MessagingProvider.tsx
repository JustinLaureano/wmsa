import React, { useContext, useEffect, useMemo, useState } from 'react';
import MessagingContext from '@/Contexts/MessagingContext';
import MessagingService from '@/Services/MessagingService';
import AuthContext from '@/Contexts/AuthContext';
import { ConversationResource, MessageResource, NewMessageRequestData } from '@/types/messaging';
import { getPrimaryAuthIdentifiers } from '@/Utils/auth';
import { JsonObject } from '@/types';

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
        const { id: participant_id, type: participant_type} = getPrimaryAuthIdentifiers(teammate, user);

        if ( !participant_id ) return;

        const response = await messagingService.getConversations(participant_id, participant_type);

        setConversations(response.data);
        setUnreadMessages(response.computed.unread_messages);
    };

    const fetchConversationMessages = async () => {
        // TODO: start loading
        if ( !activeConversation ) {
            setActiveMessages(null);
            return;
        }

        const response = await messagingService.getConversationMessages(activeConversation.uuid);

        setActiveMessages(response.data);
    };

    const handleNewMessageRequest = async (content: string) => {
        const { id: sender_id, type: sender_type} = getPrimaryAuthIdentifiers(teammate, user);

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
    };

    const handleMessageSent = (e: JsonObject) => {
        const message = e.message;

        fetchConversationMessages();
        fetchConversations();

        // if (
        //     (message.sender_type == 'teammate' && teammate && message.sender_id == teammate.clock_number) ||
        //     (message.sender_type == 'user' && user && message.sender_id == user.guid)
        // ) {
        //     fetchConversationMessages();
        //     fetchConversations();
        //     return;
        // }
        // else {
        //     fetchConversations();
        // }
    }

    useEffect(() => {
        fetchConversations();
    }, []);

    useEffect(() => {
        fetchConversationMessages();
    }, [activeConversation]);

    useEffect(() => {
        window.Echo.private(`conversation.user.${user?.guid}`)
            .listen('.message.sent', (e: any) => {
                handleMessageSent(e);
                console.log('message for user', e)
            });

        window.Echo.private(`conversation.teammate.${teammate?.clock_number}`)
            .listen('.message.sent', (e: any) => {
                handleMessageSent(e);
                console.log('message for clock number', e)
            });

        return () => {
            window.Echo.leave(`conversation.user.${user?.guid}`)
            window.Echo.leave(`conversation.teammate.${teammate?.clock_number}`)
        }
    }, [teammate, user]);

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
        teammate,
        user,
        conversations,
        unreadMessages,
        activeConversation,
        activeMessages
    ];

    const value = useMemo(() => defaultValue, dependencies);

    return (
        <MessagingContext.Provider value={value}>
            {children}
        </MessagingContext.Provider>
    );
}
