import { NotificationDrawerProps } from '@/types';
import { Divider, Stack, SwipeableDrawer, useTheme } from '@mui/material';
import NotificationsDrawerHeader from './NotificationsDrawerHeader';
import dimensions from '@/Theme/dimensions';

export default function NotificationsDrawer({ open, onOpen, onClose, ...props } : NotificationDrawerProps) {
    const theme = useTheme();

    return (
        <SwipeableDrawer
            anchor="right"
            open={open}
            onOpen={onOpen}
            onClose={onClose}
            sx={{
                zIndex: 9999,
				[`& .MuiDrawer-paper`]: {
                    backgroundImage: 'linear-gradient(rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.05))',
                    borderTopLeftRadius: 8,
                    borderBottomLeftRadius: 8,
                    height: '100vh',

                    /** Drawer below app bar */
                    // height: `calc(100vh - ${dimensions.topAppBarHeight} - ${dimensions.bottomAppBarHeight})`,
					// marginTop: `calc(${dimensions.topAppBarHeight})`,
				},
            }}
        >

            <Stack sx={{ padding: theme.spacing(1), width: theme.layouts.dashboard.notificationsDrawerWidth }}>
                <NotificationsDrawerHeader onCloseClick={onClose} />

                <Divider />
            </Stack>
        </SwipeableDrawer>
    );
}
