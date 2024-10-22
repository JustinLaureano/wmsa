import React from 'react';
import { List, ListItem, ListItemText, Stack, Typography, useTheme } from '@mui/material';
import OverflowScrollBox from '../Shared/OverflowScrollBox';

interface ConversationsListProps {

}

export default function ConversationsList({ ...props }: ConversationsListProps ) {
    const theme = useTheme();

    return (
        <OverflowScrollBox>
            <List>
                <ListItem>
                    <ListItemText
                        primary={"Jack S."}
                        secondary={
                            <React.Fragment>
                                <Typography
                                    component="span"
                                    variant="body2"
                                >
                                    to Scott, Alex, Jennifer
                                </Typography>
                            </React.Fragment>
                        }
                    />
                </ListItem>
            </List>
        </OverflowScrollBox>
    );
}
