import { useContext, useEffect, useState } from 'react';
import { Stack, useTheme } from '@mui/material';
import AuthContext from '@/Contexts/AuthContext';
import MessagingContext from '@/Contexts/MessagingContext';
import MessagesHeader from './MessagesHeader';
import MessagesList from './MessagesList';
import MessagesActions from './MessagesActions';
import MessagesPlaceholder from './MessagesPlaceholder';
import ParticipantSearch from './ParticipantSearch';

export default function MessagingContent() {
    const theme = useTheme();
    const {
        activeConversation,
        activeMessages,
        handleConversationMessagesRead,
        isStartingNewConversation,
    } = useContext(MessagingContext);
    const { user } = useContext(AuthContext);
    const [readTimeout, setReadTimeout] = useState<NodeJS.Timeout>();

    useEffect(() => {
        if (!user) return;

        if (activeConversation) {
            /**
             * Will use a timeout to mark the messages as read after 2 seconds
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
                }, 300)
            );

            return () => {
                if (readTimeout) {
                    clearTimeout(readTimeout);
                }
            };
        }
    }, [activeMessages]);

    useEffect(() => {
        console.log('isStartingNewConversation', isStartingNewConversation);
    }, [isStartingNewConversation]);

    return (
        <Stack sx={{
            height: '100%',
            marginLeft: theme.layouts.dashboard.conversationDrawerWidth
        }}>
            {
                isStartingNewConversation ?
                    <ParticipantSearch />
                    :
                    <MessagesHeader />
            }

            { activeConversation && activeMessages && <MessagesList /> }

            {
                (!activeConversation || !activeMessages) && <MessagesPlaceholder />
            }

            <MessagesActions />
        </Stack>
    );
}
