import React, { useContext, useState } from 'react';
import { router } from '@inertiajs/react';
import { IconButton, ListItemText, Menu, MenuItem } from '@mui/material';
import { AccountCircleOutlined } from '@mui/icons-material';
import AuthContext from '@/Contexts/AuthContext';
import LanguageContext from '@/Contexts/LanguageContext';

export default function AppBarUser(props: any) {
    const lang = useContext(LanguageContext);
    const { user } = useContext(AuthContext);

    const [userMenuEl, setUserMenuEl] = useState<EventTarget & HTMLElement | null>(null);
    const openUserMenu = Boolean(userMenuEl);

    const handleUserButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        setUserMenuEl(e.currentTarget);
    }

    const handleUserMenuClose = () => {
        setUserMenuEl(null);
    };

    const handleLogoutClick = () => {
        router.post(route('logout'), {}, {
            onSuccess: () => window.location.reload()
        });
    }

    return (
        <>

            <IconButton
                onClick={handleUserButtonClick}
            >
                <AccountCircleOutlined />
            </IconButton>

            <Menu
                anchorEl={userMenuEl}
                open={openUserMenu}
                onClose={handleUserMenuClose}
                MenuListProps={{
                    'aria-labelledby': 'user-menu-button',
                }}
                anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'right',
                }}
                sx={{
                    '& .MuiPaper-root': {
                        minWidth: 180
                    }
                }}
            >
                <MenuItem onClick={handleUserMenuClose}>
                    <ListItemText onClick={handleLogoutClick}>
                        Logout
                    </ListItemText>
                </MenuItem>
            </Menu>
        </>
    );
}
