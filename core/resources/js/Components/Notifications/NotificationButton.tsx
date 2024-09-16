import React, { useContext } from 'react';
import { NotificationsOutlined } from '@mui/icons-material';
import { IconButton } from '@mui/material';

export default function NotificationButton(props : Record<string, any>) {

    const handleButtonClick= (e: React.MouseEvent<HTMLElement>) => {
        console.log('needes implemented')
    }

    return (
        <IconButton
            aria-label="toggle-navigation"
            onClick={handleButtonClick}
        >
            <NotificationsOutlined />
        </IconButton>
    );
}
