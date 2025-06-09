import React, { useContext } from 'react';
import { ChatBubbleOutline, ModeCommentOutlined } from '@mui/icons-material';
import { Badge, IconButton } from '@mui/material';
import UIContext from '@/Contexts/UIContext';
import MessagingDialog from './MessagingDialog';
import MessagingContext from '@/Contexts/MessagingContext';

export default function MessagingButton() {
	const { messagesDialogOpen, setMessagesDialogOpen } = useContext(UIContext);
    const { unreadMessages } = useContext(MessagingContext);

    const handleButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        setMessagesDialogOpen(true);
    }

    const onClose = () => setMessagesDialogOpen(false);

    return (
        <>
            <IconButton
                aria-label="toggle-navigation"
                onClick={handleButtonClick}
            >
                <ChatBubbleOutline />
                <Badge
                    badgeContent={unreadMessages}
                    color="primary"
                    sx={{
                        '& .MuiBadge-badge': {
                            top: -8,
                            right: -1,
                        },
                    }}
                />
            </IconButton>

            <MessagingDialog
                open={messagesDialogOpen}
                onClose={onClose}
            />
        </>
    );
}
