import { useContext, useEffect, useState } from 'react';
import { Stack, useTheme } from '@mui/material';
import ParticipantSearch from './ParticipantSearch';
import MessagingContext from '@/Contexts/MessagingContext';
import MessagesHeader from './MessagesHeader';
import MessagesList from './MessagesList';
import MessagesActions from './MessagesActions';
import MessagesPlaceholder from './MessagesPlaceholder';
import { useAuth } from '@/Providers/AuthProvider';

export default function MessagingContent() {
    const theme = useTheme();
    const {
        activeConversation,
        activeMessages,
        handleConversationMessagesRead,
        isStartingNewConversation,
    } = useContext(MessagingContext);
    const { user } = useAuth();
    const [readTimeout, setReadTimeout] = useState<NodeJS.Timeout>();
    const [showPlaceholder, setShowPlaceholder] = useState(true);

    useEffect(() => {
        if (!user) return;

        if (activeConversation) {
            /**
             * Will use a timeout to mark the messages as read after short wait
             * This is to prevent the messages from being marked as read immediately
             */
            if (readTimeout) {
                clearTimeout(readTimeout);
            }

            setReadTimeout(
                setTimeout(() => {
                    handleConversationMessagesRead(
                        activeConversation.uuid,
                        user.uuid
                    );
                }, 400)
            );

            return () => {
                if (readTimeout) {
                    clearTimeout(readTimeout);
                }
            };
        }
    }, [activeMessages]);

    useEffect(() => {
        if (activeConversation) {
            setShowPlaceholder(false);
        }
        else {
            setShowPlaceholder(true);
        }
    }, [activeMessages, activeConversation]);

    return (
        <Stack sx={{
            height: '100%',
            marginLeft: theme.layouts.dashboard.conversationDrawerWidth
        }}>
            {
                isStartingNewConversation && !activeConversation ?
                    <ParticipantSearch />
                    :
                    <MessagesHeader />
            }

            { activeConversation && activeMessages && <MessagesList /> }

            {
                showPlaceholder && <MessagesPlaceholder />
            }

            <MessagesActions />
        </Stack>
    );
}
