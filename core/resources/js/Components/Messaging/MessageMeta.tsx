import { MessageResource } from '@/types/messaging';
import { Box } from '@mui/material';

interface MessageMetaProps {
    justify: string;
    message: MessageResource;
}

export default function MessageMeta({ justify, message, ...props }: MessageMetaProps) {
    return (
        <Box sx={{ textAlign: justify }}>
            {message.attributes.created_at}
        </Box>
    );
}
