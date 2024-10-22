import { Stack, useTheme } from '@mui/material';

interface MessagesContainerProps {
    children: React.ReactNode;
}

export default function MessagesContainer({ children, ...props }: MessagesContainerProps) {
    const theme = useTheme();

    return (
        <Stack>
            {children}
        </Stack>
    );
}
