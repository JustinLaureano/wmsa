import MessagingContext from '@/Contexts/MessagingContext';
import { Stack, useTheme } from '@mui/material';
import { useContext } from 'react';
import MessagesHeader from './MessagesHeader';
import MessagesList from './MessagesList';
import MessagesActions from './MessagesActions';
import MessagesPlaceholder from './MessagesPlaceholder';

export default function MessagingContent() {
    const theme = useTheme();
    const { activeConversation, activeMessages } = useContext(MessagingContext);

    return (
        <Stack sx={{
            height: '100%',
            marginLeft: theme.layouts.dashboard.conversationDrawerWidth
        }}>
            <MessagesHeader />

            { activeConversation && activeMessages && <MessagesList /> }

            {
                (!activeConversation || !activeMessages) && <MessagesPlaceholder />
            }

            <MessagesActions />
        </Stack>
    );
}
