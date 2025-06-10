import { useContext } from 'react';
import MessagingContext from '@/Contexts/MessagingContext';
import { Autocomplete, TextField } from '@mui/material';
import { ParticipantAutocompleteResource } from '@/types';

export default function ParticipantSearchInput() {
    const {
        participantOptions,
        setNewConversationParticipants,
        newConversationParticipants
    } = useContext(MessagingContext);

    const inputLabel = newConversationParticipants.length > 0 ? 'Participants' : 'Search';

    return (
        <Autocomplete
            multiple
            filterSelectedOptions
            options={participantOptions}
            onChange={(event, value) => {
                setNewConversationParticipants(value.map((option : ParticipantAutocompleteResource) => option.id));
            }}
            sx={{ width: '100%' }}
            renderInput={(params) => <TextField {...params} label={inputLabel} />}
        />
    );
}
