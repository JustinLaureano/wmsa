import React, { useContext } from 'react';
import { AppBar, Toolbar, Stack, Typography, useTheme } from '@mui/material';
import NavigationToggle from './NavigationToggle';
import AppBarLogo from '../Logos/AppBarLogo';
import AppBarLogin from '@/Domains/Auth/Components/AppBarLogin';
import AuthContext from '@/Contexts/AuthContext';
import AppBarUser from '@/Domains/Auth/Components/AppBarUser';

export default function TopAppBar(props : Record<string, any>) {
    const theme = useTheme();
    const { user } = useContext(AuthContext);

    return (
        <AppBar
            position="fixed"
            elevation={0}
            sx={{
                borderBottom: 1,
                borderColor: theme.palette.mode == 'light' ? '#0000001f' : '#ffffff2e',
                zIndex: (theme) => theme.zIndex.drawer + 1,
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
                        sx={{ flexGrow: 1 }}
                    >
                        <NavigationToggle />

                        <AppBarLogo />
                    </Stack>

                    <Stack
                        justifyContent="center"
                        alignItems="center"
                        sx={{
                            flexGrow: 2,
                            
                        }}
                    >
                        <Typography variant="h5" noWrap component="div">
                            WMS
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
                        {
                            user ? <AppBarUser /> : <AppBarLogin />
                        }

                    </Stack>
                </Stack>
            </Toolbar>
        </AppBar>
    );
}
