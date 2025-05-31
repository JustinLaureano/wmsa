import React, { useContext } from 'react';
import { Menu } from '@mui/icons-material';
import { IconButton } from '@mui/material';
import UIContext from '@/Contexts/UIContext';
import { JsonObject } from '@/types';

export default function NavigationToggle(props : JsonObject) {
    const { navigationDrawerOpen, setNavigationDrawerOpen } = useContext(UIContext);

    const handleMenuButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        setNavigationDrawerOpen( !navigationDrawerOpen )
    }

    return (
        <IconButton
            aria-label="toggle-navigation"
            onClick={handleMenuButtonClick}
            {...props}
        >
            <Menu />
        </IconButton>
    );
}
