import { Stack, useTheme } from '@mui/material';

interface MessagingSidebarProps {
    children: React.ReactNode;
}

export default function MessagingSidebar({ children, ...props }: MessagingSidebarProps ) {
    const theme = useTheme();

    return (
        <Stack>
            {children}
        </Stack>
    );
}
