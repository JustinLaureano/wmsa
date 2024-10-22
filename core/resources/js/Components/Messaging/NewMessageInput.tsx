import { Box, useTheme } from '@mui/material';

interface NewMessageInputProps {

}

export default function NewMessageInput({ ...props }: NewMessageInputProps ) {
    const theme = useTheme();

    return (
        <Box>Input</Box>
    );
}
