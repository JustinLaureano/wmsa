import React from 'react';
import { ListItem, ListItemText, Typography, useTheme } from '@mui/material';

interface ParticipantSearchResultItemProps {

}

export default function ParticipantSearchResultItem({ ...props }: ParticipantSearchResultItemProps ) {
    const theme = useTheme();

    return (
        <ListItem>
            <ListItemText
                primary={"John Paul Webber"}
                secondary={
                    <React.Fragment>
                        <Typography
                            component="span"
                            variant="body2"
                        >
                            Production Supervisor
                        </Typography>
                    </React.Fragment>
                }
            />
        </ListItem>
    );
}
