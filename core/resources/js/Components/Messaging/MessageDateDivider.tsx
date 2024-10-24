import { Box, useTheme } from '@mui/material';

interface MessageDateDividerProps {

}

export default function MessageDateDivider({ ...props }: MessageDateDividerProps) {
    const theme = useTheme();

    return (
        <Box>Date Divider</Box>
    );
}
