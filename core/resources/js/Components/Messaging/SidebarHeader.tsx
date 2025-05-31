import { OpenInNew } from '@mui/icons-material';
import { Divider, IconButton, Stack, Tooltip, Typography, useTheme } from '@mui/material';

export default function SidebarHeader() {
    const theme = useTheme();

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
                    Messaging
                </Typography>

                <Tooltip title="New Conversation" arrow>
                    <IconButton size="large">
                        <OpenInNew />
                    </IconButton>
                </Tooltip>
            </Stack>

            <Divider />
        </>
    );
}
