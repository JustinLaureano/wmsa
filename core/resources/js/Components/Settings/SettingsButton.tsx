import React, { useState } from 'react';
import { JsonObject } from '@/types';
import { SettingsOutlined } from '@mui/icons-material';
import { IconButton, useScrollTrigger } from '@mui/material';
import SettingsDrawer from './SettingsDrawer';

export default function SettingsButton(props : JsonObject) {

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
                <SettingsOutlined sx={{ fontSize: 24 }} />
            </IconButton>

            <SettingsDrawer
                open={open}
                onOpen={handleOnOpen}
                onClose={onClose}
            />
        </>
    );
}
