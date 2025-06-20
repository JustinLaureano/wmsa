import React from 'react';
import { List, ListItem, ListItemText, Typography, useTheme } from '@mui/material';
import OverflowScrollBox from '../Shared/OverflowScrollBox';

export default function ParticipantSearchResultList() {
    const theme = useTheme();

    return (
        <OverflowScrollBox>
            <List>
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
            </List>
        </OverflowScrollBox>
    );
}
