import { useContext } from 'react';
import { OpenInNew } from '@mui/icons-material';
import { Divider, IconButton, Stack, Tooltip, Typography, useTheme } from '@mui/material';
import MessagingContext from '@/Contexts/MessagingContext';
import LanguageContext from '@/Contexts/LanguageContext';

export default function SidebarHeader() {
    const { lang } = useContext(LanguageContext);
    const { handleStartNewConversation } = useContext(MessagingContext);
    const theme = useTheme();

    const startNewConversation = () => {
        handleStartNewConversation([]);
    };

    return (
        <>
            <Stack
                direction="row"
                alignItems="center"
                justifyContent="space-between"
                sx={{
                    padding: 2
                }}
            >
                <Typography variant="h3">
                    {lang.messaging}
                </Typography>

                <Tooltip title="New Conversation" arrow>
                    <IconButton
                        size="large"
                        onClick={startNewConversation}
                    >
                        <OpenInNew />
                    </IconButton>
                </Tooltip>
            </Stack>

            <Divider />
        </>
    );
}
