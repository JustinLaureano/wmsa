import { Divider, Stack, SwipeableDrawer, useTheme } from '@mui/material';
import NotificationsDrawerHeader from './NotificationsDrawerHeader';
import dimensions from '@/Theme/dimensions';

interface NotificationsDrawerProps {
    open: boolean;
    onOpen: () => void;
    onClose: () => void;
}

export default function NotificationsDrawer({ open, onOpen, onClose, ...props } : NotificationsDrawerProps) {
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
