import { Stack, useTheme } from '@mui/material';

interface MessagesContentProps {

}

export default function MessagesContent({ ...props }: MessagesContentProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ marginLeft: theme.layouts.dashboard.conversationDrawerWidth }}>
            Dialog Content Here
        </Stack>
    );
}
