import { Divider, Stack, SwipeableDrawer, useTheme } from '@mui/material';
import dimensions from '@/Theme/dimensions';
import NotificationsDrawerHeader from './NotificationsDrawerHeader';

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
				[`& .MuiDrawer-paper`]: {
                    borderTopLeftRadius: 10,
                    borderBottomLeftRadius: 10,
                    height: `calc(100vh - ${dimensions.topAppBarHeight} - ${dimensions.bottomAppBarHeight})`,
					marginTop: `calc(${dimensions.topAppBarHeight})`,
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
