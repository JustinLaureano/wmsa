import MessagingContext from '@/Contexts/MessagingContext';
import { Divider, Stack, Typography } from '@mui/material';
import { useContext } from 'react';

export default function MessagesHeader() {
    const { activeConversation } = useContext(MessagingContext);

    return (
        <>
            <Stack
                direction="row"
                alignItems="center"
                sx={{
                    height: '80px'
                }}
            >
                <Typography variant="h3">
                    {activeConversation?.computed.title || 'Messages'}
                </Typography>

            </Stack>
            <Divider />
        </>
    );
}
