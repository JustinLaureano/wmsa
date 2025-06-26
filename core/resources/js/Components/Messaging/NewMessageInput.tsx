import React, { useContext, useEffect, useRef, useState } from 'react';
import { Divider, IconButton, Paper, Stack } from '@mui/material';
import { Send } from '@mui/icons-material';
import StyledInputBase from '../Styled/StyledInputBase';
import MessagingContext from '@/Contexts/MessagingContext';
import { useAuth } from '@/Providers/AuthProvider';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function NewMessageInput() {
    const { lang } = useLanguage();
    const { user } = useAuth();
    const {
        activeConversation,
        handleNewMessageRequest,
        newConversationParticipants,
        isStartingNewConversation,
        handleCreateNewConversation,
        setActiveConversation,
        conversationExists,
    } = useContext(MessagingContext);

    const [content, setContent] = useState('');
    const [awaitingActiveConversation, setAwaitingActiveConversation] = useState(false);
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
        if (!user) return;

        if (isStartingNewConversation && newConversationParticipants.length > 0) {

            const existingConversation = conversationExists();

            if (existingConversation) {
                // Set as active conversation and send message
                setAwaitingActiveConversation(true);
                setActiveConversation(existingConversation);

            } else {
                // Create new conversation
                handleCreateNewConversation(content);
            }

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
        if (awaitingActiveConversation) {
            setAwaitingActiveConversation(false);
            handleNewMessage();
            return;
        }

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
                    placeholder={lang.type_a_message}
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
