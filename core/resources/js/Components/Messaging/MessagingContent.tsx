import MessagingContext from '@/Contexts/MessagingContext';
import { Stack, useTheme } from '@mui/material';
import { useContext } from 'react';
import MessagesHeader from './MessagesHeader';
import MessagesList from './MessagesList';

interface MessagingContentProps {}

export default function MessagingContent({ ...props }: MessagingContentProps) {
    const theme = useTheme();
    const { activeConversation, activeMessages } = useContext(MessagingContext);

    return (
        <Stack sx={{ marginLeft: theme.layouts.dashboard.conversationDrawerWidth }}>
            <MessagesHeader />


            { activeConversation && activeMessages && <MessagesList /> }
        </Stack>
    );
}
