import React, { useContext } from 'react';
import ColorModeContext from '@/Contexts/ColorModeContext';
import LanguageContext from '@/Contexts/LanguageContext';
import { Brightness6, LightMode } from '@mui/icons-material';
import { Box, ToggleButton, ToggleButtonGroup, Typography, useTheme } from '@mui/material';

interface ThemeSettingsProps {

}

export default function ThemeSettings({ ...props } : ThemeSettingsProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);
    const colorMode = useContext(ColorModeContext);

    const handleChange = (
        e: React.MouseEvent<HTMLElement>,
        newMode: string
    ) => {
        if (newMode && theme.palette.mode  != newMode) {
            colorMode.toggleColorMode();
        }
    }

    return (

        <Box sx={{ p: theme.spacing(2) }}>
            
            <Typography variant="h5">
                { lang.light_dark_mode }
            </Typography>

            <ToggleButtonGroup
                color="primary"
                value={theme.palette.mode}
                exclusive
                onChange={handleChange}
                sx={{
                    mt: theme.spacing(2),
                    mb: theme.spacing(1)
                }}
            >
                <ToggleButton value="light">
                    <LightMode />
                </ToggleButton>
                <ToggleButton value="dark">
                    <Brightness6 />
                </ToggleButton>
            </ToggleButtonGroup>
        </Box>
    );
}
