import MessagingContext from '@/Contexts/MessagingContext';
import { Box, Stack, useTheme } from '@mui/material';
import { useContext } from 'react';
import MessagesHeader from './MessagesHeader';
import MessagesList from './MessagesList';
import OverflowScrollBox from '../Shared/OverflowScrollBox';
import MessagesActions from './MessagesActions';

interface MessagingContentProps {}

export default function MessagingContent({ ...props }: MessagingContentProps) {
    const theme = useTheme();
    const { activeConversation, activeMessages } = useContext(MessagingContext);

    return (
        <Stack sx={{
            height: '100%',
            marginLeft: theme.layouts.dashboard.conversationDrawerWidth,
            paddingLeft: 2.5
        }}>
            <MessagesHeader />

            { activeConversation && activeMessages && <MessagesList /> }

            <MessagesActions />
        </Stack>
    );
}
