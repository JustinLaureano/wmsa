import React from 'react';
import { Avatar, Badge, Box, Divider, IconButton, ListItemAvatar, ListItemButton, ListItemText, Stack, Typography, useTheme } from '@mui/material';
import { ConversationResource } from '@/types/messaging';
import { Delete, Folder } from '@mui/icons-material';
import { getRandomAvatarBadgeColor } from '@/Theme/colors';

interface ConversationsListItemProps {
    conversation: ConversationResource
}

export default function ConversationsListItem({ conversation, ...props }: ConversationsListItemProps ) {
    const { avatar_initials, title, subject, latest_message_date } = conversation.computed;

    return (
        <>
            <ListItemButton
                selected={false}
            >
                <ListItemAvatar>
                    <Avatar  sx={{ bgcolor: getRandomAvatarBadgeColor() }}>
                        {avatar_initials}
                    </Avatar>
                </ListItemAvatar>

                <ListItemText
                    primary={title}
                    secondary={
                        <React.Fragment>
                            <Typography
                                component="span"
                                variant="body2"
                            >
                                {subject}
                            </Typography>
                        </React.Fragment>
                    }
                />

                <Stack alignSelf="stretch" sx={{ mt: 1 }}>
                    <Typography variant="body2">{latest_message_date}</Typography>
                </Stack>

            </ListItemButton>

            <Divider component="li" />
        </>
    );
}
