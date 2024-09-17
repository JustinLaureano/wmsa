import { Divider, Stack, SwipeableDrawer, useTheme } from '@mui/material';
import SettingsHeader from './SettingsHeader';
import LanguageSettings from './LanguageSettings';
import ThemeSettings from './ThemeSettings';
import dimensions from '@/Theme/dimensions';

interface SettingsDrawerProps {
    open: boolean;
    onOpen: () => void;
    onClose: () => void;
}

export default function SettingsDrawer({ open, onOpen, onClose, ...props } : SettingsDrawerProps) {
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

            <Stack sx={{ padding: theme.spacing(1), width: theme.layouts.dashboard.settingsDrawerWidth }}>
                <SettingsHeader onCloseClick={onClose} />

                <Divider />

                <LanguageSettings />

                <Divider />

                <ThemeSettings />

                <Divider />
            </Stack>
        </SwipeableDrawer>
    );
}
