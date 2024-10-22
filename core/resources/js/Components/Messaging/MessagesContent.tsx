import { Stack, useTheme } from '@mui/material';

interface MessagesContentProps {
    children: React.ReactNode;
}

export default function MessagesContent({ children, ...props }: MessagesContentProps) {
    const theme = useTheme();

    return (
        <Stack>
            {children}
        </Stack>
    );
}
