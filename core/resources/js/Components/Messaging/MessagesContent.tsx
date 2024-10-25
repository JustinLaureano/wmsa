import { Stack, useTheme } from '@mui/material';

interface MessagesContentProps {

}

export default function MessagesContent({ ...props }: MessagesContentProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ marginLeft: '320px' }}>
            Dialog Content Here
        </Stack>
    );
}
