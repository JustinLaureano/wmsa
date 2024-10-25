import React, { useMemo } from 'react';
import {
    Avatar, Box, Divider, ListItemAvatar,
    ListItemButton, ListItemText, Stack, Typography
} from '@mui/material';
import { ConversationResource } from '@/types/messaging';
import { getRandomAvatarBadgeColor } from '@/Theme/colors';
import UnreadConversationMessagesBadge from './UnreadConversationMessagesBadge';

interface ConversationsListItemProps {
    conversation: ConversationResource
}

export default function ConversationsListItem({ conversation, ...props }: ConversationsListItemProps ) {
    const {
        avatar_initials,
        title,
        subject,
        latest_message_date,
        unread_messages
    } = conversation.computed;

    const badgeColor = useMemo(() => getRandomAvatarBadgeColor(), [conversation.uuid]);

    return (
        <>
            <ListItemButton
                selected={false}
            >
                <ListItemAvatar>
                    {unread_messages ? (
                        <UnreadConversationMessagesBadge
                            badgeColor={badgeColor}
                            avatarInitials={avatar_initials}
                        />
                    ) : (
                        <Avatar sx={{ bgcolor: badgeColor }}>
                            {avatar_initials}
                        </Avatar>
                    )}

                </ListItemAvatar>

                <ListItemText
                    disableTypography={true}
                    primary={
                        <React.Fragment>
                            <Box
                                sx={{
                                    overflow: 'hidden',
                                    textOverflow: 'ellipsis',
                                    whiteSpace: 'nowrap',
                                    width: '180px'
                                }}
                            >
                                <Typography
                                    component="span"
                                    variant="body1"
                                    noWrap
                                    sx={{
                                        fontWeight: unread_messages ? '600' : '400'
                                    }}
                                >
                                    {title}
                                </Typography>
                            </Box>
                        </React.Fragment>
                    }
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
                                    color={unread_messages ? 'textPrimary' : 'gray'}
                                    sx={{
                                        fontWeight: unread_messages ? '500' : '400'
                                    }}
                                >
                                    {subject}
                                </Typography>
                            </Box>
                        </React.Fragment>
                    }
                />

                <Stack alignSelf="stretch" sx={{ mt: 1 }}>
                    <Typography
                        variant="body2"
                        color={unread_messages ? 'textPrimary' : 'gray'}
                        sx={{
                            fontWeight: unread_messages ? '500' : '400'
                        }}
                    >
                        {latest_message_date}
                    </Typography>
                </Stack>

            </ListItemButton>

            <Divider component="li" />
        </>
    );
}
