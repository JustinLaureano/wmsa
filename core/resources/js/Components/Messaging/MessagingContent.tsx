import { Stack, useTheme } from '@mui/material';

interface MessagingContentProps {
    children: React.ReactNode;
}

export default function MessagingContent({ children, ...props }: MessagingContentProps) {
    const theme = useTheme();

    return (
        <Stack>
            {children}
        </Stack>
    );
}
