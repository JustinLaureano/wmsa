import React, { useMemo } from 'react';
import {
    Avatar, Box, Divider, ListItemAvatar,
    ListItemButton, ListItemText, Stack, Typography
} from '@mui/material';
import { ConversationResource } from '@/types/messaging';
import { getRandomAvatarBadgeColor } from '@/Theme/colors';

interface ConversationsListItemProps {
    conversation: ConversationResource
}

export default function ConversationsListItem({ conversation, ...props }: ConversationsListItemProps ) {
    const { avatar_initials, title, subject, latest_message_date } = conversation.computed;

    const badgeColor = useMemo(() => getRandomAvatarBadgeColor(), [conversation.uuid]);

    return (
        <>
            <ListItemButton
                selected={false}
            >
                <ListItemAvatar>
                    <Avatar  sx={{ bgcolor: badgeColor }}>
                        {avatar_initials}
                    </Avatar>
                </ListItemAvatar>

                <ListItemText
                    disableTypography={true}
                    primary={title}
                    secondary={
                        <React.Fragment>
                            <Box
                                sx={{
                                    overflow: 'hidden',
                                    textOverflow: 'ellipsis',
                                    whiteSpace: 'nowrap',
                                    width: '210px'
                                }}
                            >
                                <Typography
                                    component="span"
                                    variant="body2"
                                    noWrap
                                >
                                    {subject}
                                </Typography>
                            </Box>
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
