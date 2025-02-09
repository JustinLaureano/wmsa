import React, { useContext } from 'react';
import { AppBar, Toolbar, Stack, Typography, useTheme } from '@mui/material';
import NavigationToggle from './NavigationToggle';
import AppBarLogin from '@/Domains/Auth/Components/AppBarLogin';
import AuthContext from '@/Contexts/AuthContext';
import AppBarUser from '@/Domains/Auth/Components/AppBarUser';
import NotificationsButton from '@/Components/Notifications/NotificationsButton';
import SettingsButton from '../Settings/SettingsButton';
import SearchButton from '../Search/SearchButton';
import MessagingButton from '../Messaging/MessagingButton';

interface TopAppBarProps {
    title: string;
}

export default function TopAppBar({ title, ...props } : TopAppBarProps) {
    const theme = useTheme();
    const { user } = useContext(AuthContext);

    return (
        <AppBar
            position="fixed"
            elevation={0}
            sx={{
                borderBottom: 1,
                borderColor: theme.palette.mode == 'light' ? '#0000001f' : '#ffffff2e',
                '& .MuiToolbar-root': {
                    paddingLeft: '.5rem',
                  },
            }}>
            <Toolbar variant="dense">
                <Stack
                    direction="row"
                    sx={{ flexGrow: 1 }}
                >
                    <Stack
                        direction="row"
                        alignItems="center"
                        spacing={theme.spacing(1)}
                        sx={{ flexGrow: 1, ml: theme.spacing(2) }}
                    >
                        <NavigationToggle />

                        <Typography variant="h6">
                            Prospira America Co
                        </Typography>
                    </Stack>

                    <Stack
                        justifyContent="center"
                        alignItems="center"
                        sx={{
                            flexGrow: 2,

                        }}
                    >
                        <Typography variant="h6">
                            WMS {title && `- ${title}`}
                        </Typography>
                    </Stack>

                    <Stack
                        direction="row"
                        justifyContent="right"
                        alignItems="center"
                        sx={{
                            flexGrow: 1,

                        }}
                    >

                        <SearchButton />

                        <NotificationsButton />

                        {
                            user &&
                            <MessagingButton />
                        }

                        <SettingsButton />

                        {
                            user ? <AppBarUser /> : <AppBarLogin />
                        }

                    </Stack>
                </Stack>
            </Toolbar>
        </AppBar>
    );
}
