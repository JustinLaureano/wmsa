import { Box, useTheme } from '@mui/material';

interface ParticipantSearchInputProps {

}

export default function ParticipantSearchInput({ ...props }: ParticipantSearchInputProps ) {
    const theme = useTheme();

    return (
        <Box>Participant Search</Box>
    );
}
