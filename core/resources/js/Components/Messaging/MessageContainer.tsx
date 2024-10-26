import { Box, Stack} from '@mui/material';

interface MessageContainerProps {
    justify: string;
    children: React.ReactNode;
}

export default function MessageContainer({ justify, children, ...props }: MessageContainerProps) {
    return (
        <Stack
            direction="row"
            justifyContent={justify}
            sx={{ py: 2 }}
            {...props}
        >
            <Box
                sx={{ width: '60%' }}
            >
                {children}
            </Box>
        </Stack>
    );
}
