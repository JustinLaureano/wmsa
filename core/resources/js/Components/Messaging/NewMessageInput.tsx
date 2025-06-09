import React, { useContext, useEffect, useRef, useState } from 'react';
import { Divider, IconButton, Paper, Stack } from '@mui/material';
import { Send } from '@mui/icons-material';
import StyledInputBase from '../Styled/StyledInputBase';
import MessagingContext from '@/Contexts/MessagingContext';
import Message from './Message';

export default function NewMessageInput() {
    const {
        activeConversation,
        handleNewMessageRequest,
        newConversationParticipants,
        isStartingNewConversation,
        handleCreateNewConversation
    } = useContext(MessagingContext);
    const [content, setContent] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setContent(e.target.value)
    }

    const handleNewMessage = async () => {
        const message = await handleNewMessageRequest(content);

        if (!message) return;

        setContent('');
        focusInput();
    }

    const handleButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        if (isStartingNewConversation && newConversationParticipants.length > 0) {
            // determine if actually new conversation based on participants
            // if it is, create new conversation
            // if it is not, set active conversation and add new message
            handleCreateNewConversation(content);
            return;
        }

        handleNewMessage();
    }

    const handleKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter' && e.shiftKey) {
            e.preventDefault();
            setContent(content => `${content}\n`);
            return;
        }

        if (e.key !== 'Enter') return;

        e.preventDefault();
        handleNewMessage();
    }

    const focusInput = () => {
        if (inputRef.current) {
            inputRef.current.focus();
        }
    }

    const sendButtonIsDisabled = () => {
        if (content.length === 0) return true;

        if (isStartingNewConversation) {
            if (newConversationParticipants.length === 0) return true;
        }

        return false;
    }

    useEffect(() => {
        setContent('');
        focusInput();
    }, [activeConversation])

    useEffect(() => focusInput(), []);

    return (
        <Paper
            elevation={0}
            variant="outlined"
            sx={{
                p: '3px 8px',
                minWidth: '240px',
                boxShadow: 'none'
            }}
        >
            <Stack
                direction="row"
                alignItems="center"
            >
                <StyledInputBase
                    inputRef={inputRef}
                    placeholder={'Type a message'}
                    value={content}
                    onChange={handleInputChange}
                    onKeyDown={handleKeyDown}
                    multiline
                    maxRows={2}
                    sx={{ flexGrow: 1 }}
                />

                <Divider
                    orientation="vertical"
                    flexItem
                    sx={{ mr: 1 }}
                />

                <IconButton
                    color="primary"
                    disabled={sendButtonIsDisabled() ? true : false}
                    onClick={handleButtonClick}
                >
                    <Send />
                </IconButton>
            </Stack>
        </Paper>
    );
}
