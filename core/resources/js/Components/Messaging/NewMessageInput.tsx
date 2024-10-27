import { Send } from '@mui/icons-material';
import { Divider, IconButton, Paper, Stack } from '@mui/material';
import StyledInputBase from '../Styled/StyledInputBase';

export default function NewMessageInput() {

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        console.log(e.target.value)
    }

    return (
        <Paper
            elevation={0}
            variant="outlined"
            sx={{
                p: '3px 8px',
                minWidth: '240px',
                boxShadow: 'none'
            }}
        >
            <Stack
                direction="row"
                alignItems="center"
            >
                <StyledInputBase
                    placeholder={'Type a message'}
                    onChange={handleInputChange}
                />

                <Divider
                    orientation="vertical"
                    flexItem
                    sx={{ pl: 1 }}
                />

                <IconButton>
                    <Send />
                </IconButton>
            </Stack>
        </Paper>
    );
}
