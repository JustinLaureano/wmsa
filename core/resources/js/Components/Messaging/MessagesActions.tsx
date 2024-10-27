import { Box, Divider, Stack } from '@mui/material';
import NewMessageInput from './NewMessageInput';

export default function MessagesActions() {

    return (
        <>
            <Divider />
            <Stack
                direction="row"
                alignItems="center"
                justifyContent="center"
                sx={{
                    minHeight: '80px',
                    maxHeight: '80px'
                }}
            >
                <Box sx={{ width: '80%' }}>
                    <NewMessageInput />
                </Box>
            </Stack>
        </>
    );
}
