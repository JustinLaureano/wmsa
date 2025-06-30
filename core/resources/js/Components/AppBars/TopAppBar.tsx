import { AppBar, Toolbar, Stack, Typography, useTheme } from '@mui/material';
import { TopAppBarProps } from '@/types';
import NavigationToggle from './NavigationToggle';
import AppBarLogin from '@/Domains/Auth/Components/AppBarLogin';
import { useAuth } from '@/Providers/AuthProvider';
import AppBarUser from '@/Domains/Auth/Components/AppBarUser';
import NotificationsButton from '@/Components/Notifications/NotificationsButton';
import SettingsButton from '../Settings/SettingsButton';
import SearchButton from '../Search/SearchButton';
import MessagingButton from '../Messaging/MessagingButton';
import PrimaryLogo from '../PrimaryLogo';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function TopAppBar({ title, ...props } : TopAppBarProps) {
    const { lang } = useLanguage();
    const theme = useTheme();
    const { user } = useAuth();

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
                        sx={{ flexGrow: 1 }}
                    >
                        <NavigationToggle />

                        <PrimaryLogo height={16} />

                        <Typography
                            fontSize={21}
                            fontWeight={500}
                            sx={{ lineHeight: 1 }}
                        >
                            | {lang.wms}
                        </Typography>
                    </Stack>

                    <Stack
                        justifyContent="center"
                        alignItems="center"
                        sx={{
                            flexGrow: 2,

                        }}
                    >
                        <SearchButton />
                    </Stack>

                    <Stack
                        direction="row"
                        justifyContent="right"
                        alignItems="center"
                        spacing={1}
                        sx={{
                            flexGrow: 1,
                        }}
                    >
                        {
                            user &&
                            <NotificationsButton />
                        }

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
