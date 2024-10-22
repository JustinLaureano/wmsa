import { Box, useTheme } from '@mui/material';

interface ParticipantSearchProps {

}

export default function ParticipantSearch({ ...props }: ParticipantSearchProps) {
    const theme = useTheme();

    return (
        <Box>Participant Search</Box>
    );
}
