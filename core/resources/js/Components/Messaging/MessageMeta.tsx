import { Box, useTheme } from '@mui/material';

interface MessageMetaProps {

}

export default function MessageMeta({ ...props }: MessageMetaProps) {
    const theme = useTheme();

    return (
        <Box>
            meta data
        </Box>
    );
}
