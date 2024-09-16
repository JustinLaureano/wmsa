import { Box, Divider, List, Stack, SwipeableDrawer, Toolbar, useTheme } from '@mui/material';
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
				[`& .MuiDrawer-paper`]: {
                    borderTopLeftRadius: 10,
                    borderBottomLeftRadius: 10,
                    height: `calc(100vh - ${dimensions.topAppBarHeight} - ${dimensions.bottomAppBarHeight})`,
					marginTop: `calc(${dimensions.topAppBarHeight})`,
				},
            }}
        >

            {/* <Toolbar variant="dense" /> */}

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
