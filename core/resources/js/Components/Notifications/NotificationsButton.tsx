import React, { useState } from 'react';
import { JsonObject } from '@/types';
import { NotificationsOutlined } from '@mui/icons-material';
import { IconButton } from '@mui/material';
import NotificationsDrawer from './NotificationsDrawer';

export default function NotificationsButton(props : JsonObject) {

    const [open, setOpen] = useState(false);

    const handleButtonClick= (e: React.MouseEvent<HTMLElement>) => {
        setOpen(true);
    }

    const handleOnOpen = () => setOpen(true);

    const onClose = () => setOpen(false);
    return (
        <>
            <IconButton
                aria-label="toggle-navigation"
                onClick={handleButtonClick}
            >
                <NotificationsOutlined />
            </IconButton>

            <NotificationsDrawer
                open={open}
                onOpen={handleOnOpen}
                onClose={onClose}
            />
        </>
    );
}
