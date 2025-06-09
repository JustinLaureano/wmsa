import { Divider, Stack } from '@mui/material';
import ParticipantSearchInput from './ParticipantSearchInput';

export default function ParticipantSearch() {

    return (
        <>
            <Stack
                direction="row"
                alignItems="center"
                sx={{
                    maxHeight: '68px',
                    minHeight: '68px',
                    px: 2
                }}
            >
                <ParticipantSearchInput />
            </Stack>
            <Divider />
        </>
    );
}
