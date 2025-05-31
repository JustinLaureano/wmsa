import { Box, Stack} from '@mui/material';
import { MessageContainerProps } from '@/types';

export default function MessageContainer({ justify, children, ...props }: MessageContainerProps) {
    return (
        <Stack
            direction="row"
            justifyContent={justify}
            sx={{ py: 2 }}
            {...props}
        >
            <Box
                sx={{
                    width: '60%',
                    minWidth: '400px',
                    maxWidth: '95%'
                }}
            >
                {children}
            </Box>
        </Stack>
    );
}
