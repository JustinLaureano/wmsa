import React from 'react';
import { ListItem, ListItemText, Typography, useTheme } from '@mui/material';

interface ConversationsListItemProps {

}

export default function ConversationsListItem({ ...props }: ConversationsListItemProps ) {
    const theme = useTheme();

    return (
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
    );
}
