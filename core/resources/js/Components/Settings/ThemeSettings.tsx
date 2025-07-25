import React, { useContext } from 'react';
import ColorModeContext from '@/Contexts/ColorModeContext';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Brightness6, LightMode } from '@mui/icons-material';
import { Box, ToggleButton, ToggleButtonGroup, Typography, useTheme } from '@mui/material';

export default function ThemeSettings() {
    const theme = useTheme();
    const { lang } = useLanguage();
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
