import React, { useState } from 'react';
import { Settings } from '@mui/icons-material';
import { IconButton, useScrollTrigger } from '@mui/material';
import SettingsDrawer from './SettingsDrawer';

export default function SettingsButton(props : Record<string, any>) {

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
                <Settings />
            </IconButton>

            <SettingsDrawer
                open={open}
                onOpen={handleOnOpen}
                onClose={onClose}
            />
        </>
    );
}