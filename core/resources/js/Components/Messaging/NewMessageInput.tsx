import React, { useContext, useEffect, useRef, useState } from 'react';
import { Divider, IconButton, Paper, Stack } from '@mui/material';
import { Send } from '@mui/icons-material';
import StyledInputBase from '../Styled/StyledInputBase';
import MessagingContext from '@/Contexts/MessagingContext';

export default function NewMessageInput() {
    const { activeConversation, handleNewMessageRequest } = useContext(MessagingContext);
    const [content, setContent] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setContent(e.target.value)
    }

    const handleNewMessage = async () => {
        const response = await handleNewMessageRequest(content);

        console.log('response', response)
    }

    const handleButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        handleNewMessage();
    }

    const handleKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key !== 'Enter') return;

        handleNewMessage();
    }

    const focusInput = () => {
        if (inputRef.current) {
            inputRef.current.focus();
        }
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
                    color="gray"
                    onClick={handleButtonClick}
                >
                    <Send />
                </IconButton>
            </Stack>
        </Paper>
    );
}
