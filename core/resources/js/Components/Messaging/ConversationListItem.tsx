import { useContext, useMemo } from 'react';
import {
    Avatar, Badge, Box, Divider, ListItemAvatar,
    ListItemButton, ListItemText, Stack, Typography
} from '@mui/material';
import { ConversationListItemProps } from '@/types';
import { getRandomAvatarBadgeColor } from '@/Theme/colors';
import UnreadConversationMessagesBadge from './UnreadConversationMessagesBadge';
import MessagingContext from '@/Contexts/MessagingContext';
import { useTheme } from '@emotion/react';

export default function ConversationsListItem({ conversation, ...props }: ConversationListItemProps ) {
    const theme = useTheme();
    const { activeConversation, setActiveConversation } = useContext(MessagingContext)

    if (!conversation.computed) return;

    const {
        title,
        subject,
        latest_message_date,
        unread_messages,
    } = conversation.computed;

    const badgeColor = useMemo(() => getRandomAvatarBadgeColor(), [conversation.uuid]);

    const handleButtonClick = () => {
        setActiveConversation(conversation)
    }

    return (
        <>
            <ListItemButton
                selected={activeConversation?.uuid == conversation.uuid}
                onClick={handleButtonClick}
            >
                <ListItemAvatar>
                    {unread_messages ? (
                        <UnreadConversationMessagesBadge
                            badgeColor={badgeColor}
                        />
                    ) : (
                        <Avatar sx={{ bgcolor: badgeColor }} />
                    )}
                </ListItemAvatar>

                <ListItemText
                    disableTypography={true}
                    primary={
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
                    }
                    secondary={
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

                    <Stack
                        alignItems="center"
                        justifyContent="center"
                        sx={{
                            height: 20,
                            width: 20,
                            borderRadius: '50%',
                            bgcolor: theme.palette.primary.light,
                            color: theme.palette.primary.contrastText,
                            fontSize: '0.75rem',
                            fontWeight: 'bold',
                            textAlign: 'center',
                            lineHeight: 1,
                        }}
                    >
                        {unread_messages}
                    </Stack>
                </Stack>

            </ListItemButton>

            <Divider component="li" />
        </>
    );
}
