import { Box, Divider, List, Stack, SwipeableDrawer, Toolbar, useTheme } from '@mui/material';
import SettingsHeader from './SettingsHeader';
import LanguageSettings from './LanguageSettings';

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
        >

            <Toolbar variant="dense" />

            <Stack sx={{ padding: theme.spacing(1), width: theme.layouts.dashboard.settingsDrawerWidth }}>
                <SettingsHeader onCloseClick={onClose} />

                <Divider />

                <LanguageSettings />

                <Divider />
            </Stack>
        </SwipeableDrawer>
    );
}
