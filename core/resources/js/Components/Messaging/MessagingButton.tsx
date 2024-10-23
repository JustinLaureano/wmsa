import React, { useContext } from 'react';
import { ChatBubbleOutline, ModeCommentOutlined } from '@mui/icons-material';
import { IconButton } from '@mui/material';
import UIContext from '@/Contexts/UIContext';
import MessagingDialog from './MessagingDialog';

export default function MessagingButton() {
	const { messagesDialogOpen, setMessagesDialogOpen } = useContext(UIContext);

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
            </IconButton>

            <MessagingDialog
                open={messagesDialogOpen}
                onClose={onClose}
            />
        </>
    );
}
