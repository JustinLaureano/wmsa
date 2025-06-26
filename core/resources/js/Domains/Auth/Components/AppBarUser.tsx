import React, { useContext, useState } from 'react';
import { router } from '@inertiajs/react';
import {
    Avatar,
    Divider,
    IconButton,
    ListItemIcon,
    ListItemText,
    Menu,
    MenuItem,
    Stack,
    Typography,
    useTheme
} from '@mui/material';
import { orange } from '@mui/material/colors';
import { AccountCircleOutlined, LogoutOutlined, PersonOutline } from '@mui/icons-material';
import { useAuth } from '@/Providers/AuthProvider';
import LanguageContext from '@/Contexts/LanguageContext';

export default function AppBarUser() {
    const { lang } = useContext(LanguageContext);
    const { user } = useAuth();
    const theme = useTheme();

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

    const handleUserProfileClick = () => {
        router.get(route('user.profile', {
            user: user?.uuid
        }));
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
                anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'right',
                }}
                sx={{
                    '& .MuiPaper-root': {
                        minWidth: 200,
                    }
                }}
            >
                <MenuItem>
                    <Stack
                        alignItems="center"
                        justifyContent="center"
                        sx={{
                            width: '100%',
                            px: 2,
                            py: 1
                        }}
                        spacing={2}
                    >
                        <Avatar
                            sx={{
                                height: 50,
                                width: 50,
                                bgcolor: orange[300],
                            }}
                        >
                            <PersonOutline
                                sx={{
                                    fontSize: 32
                                }}
                            />
                        </Avatar>

                        <Stack
                            spacing={0}
                            alignItems="center"
                        >
                            <Typography
                                variant="body1"
                                fontWeight={500}
                                fontSize={20}
                                sx={{
                                    color: theme.palette.mode === 'light'
                                        ? theme.palette.primary.main
                                        : theme.palette.text.primary,
                                    mb: 1
                                }}
                            >
                                {user?.display_name}
                            </Typography>

                            <Typography variant="body2" fontWeight={500}>
                                {user?.title}
                            </Typography>

                            <Typography variant="body2" color="text.secondary">
                                {user?.department}
                            </Typography>
                        </Stack>
                    </Stack>
                </MenuItem>

                <Divider />

                <MenuItem onClick={handleUserProfileClick}>
                    <ListItemIcon>
                        <AccountCircleOutlined />
                    </ListItemIcon>
                    <ListItemText onClick={handleUserProfileClick}>
                        {lang.view_profile}
                    </ListItemText>
                </MenuItem>

                <Divider />

                <MenuItem onClick={handleUserMenuClose}>
                    <ListItemIcon>
                        <LogoutOutlined />
                    </ListItemIcon>
                    <ListItemText onClick={handleLogoutClick}>
                        {lang.logout}
                    </ListItemText>
                </MenuItem>
            </Menu>
        </>
    );
}
