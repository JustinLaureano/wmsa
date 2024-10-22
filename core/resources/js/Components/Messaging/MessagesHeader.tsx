import { Stack, Typography, useTheme } from '@mui/material';

interface MessagesHeaderProps {
    children: React.ReactNode;
}

export default function MessagesHeader({ children, ...props }: MessagesHeaderProps ) {
    const theme = useTheme();

    return (
        <Stack
            direction="row"
            alignItems="center"
        >
            <Typography variant="h6">Messages</Typography>
        </Stack>
    );
}
