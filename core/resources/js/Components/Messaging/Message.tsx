import { Stack, useTheme } from '@mui/material';
import MessagesContainer from './MessageContainer';

interface MessageProps {
    children: React.ReactNode;
}

export default function Message({ children, ...props }: MessageProps) {
    const theme = useTheme();

    return (
        <MessagesContainer>
            {children}
        </MessagesContainer>
    );
}
