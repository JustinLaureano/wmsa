import React from 'react';
import { Settings } from '@mui/icons-material';
import { IconButton } from '@mui/material';

export default function SettingsButton(props : Record<string, any>) {

    const handleButtonClick= (e: React.MouseEvent<HTMLElement>) => {
        console.log('needes implemented')
    }

    return (
        <IconButton
            aria-label="toggle-navigation"
            onClick={handleButtonClick}
        >
            <Settings />
        </IconButton>
    );
}
