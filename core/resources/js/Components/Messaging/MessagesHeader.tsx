import { Stack, Typography } from '@mui/material';

export default function MessagesHeader() {
    return (
        <Stack
            direction="row"
            alignItems="center"
        >
            <Typography variant="h6">Messages</Typography>
        </Stack>
    );
}
