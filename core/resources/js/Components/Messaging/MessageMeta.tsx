import { MessageMetaProps } from '@/types';
import { Box, Typography } from '@mui/material';

export default function MessageMeta({ justify, message, ...props }: MessageMetaProps) {
    if ( !message.computed ) return null;

    const { sender_name, sent_at_date } = message.computed;

    return (
        <Box sx={{ textAlign: justify }}>
            <Typography variant="caption">
                {sender_name} {sent_at_date}
            </Typography>
        </Box>
    );
}
