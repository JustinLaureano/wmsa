import { MessageResource } from '@/types/messaging';
import { Box, Typography } from '@mui/material';

interface MessageMetaProps {
    justify: string;
    message: MessageResource;
}

export default function MessageMeta({ justify, message, ...props }: MessageMetaProps) {
    const { sender_name, sent_at_date } = message.computed;

    return (
        <Box sx={{ textAlign: justify }}>
            <Typography variant="caption">
                {sender_name} {sent_at_date}
            </Typography>
        </Box>
    );
}
