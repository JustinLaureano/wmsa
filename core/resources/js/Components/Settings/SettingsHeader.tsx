import LanguageContext from '@/Contexts/LanguageContext';
import { Close } from '@mui/icons-material';
import { IconButton, Stack, Typography, useTheme } from '@mui/material';
import { useContext } from 'react';

interface SettingsHeaderProps {
    onCloseClick: () => void;
}

export default function SettingsHeader({ onCloseClick, ...props } : SettingsHeaderProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    return (
        <Stack direction="row" alignItems="center">

                <IconButton onClick={onCloseClick}>
                    <Close />
                </IconButton>

                <Typography
                    variant="h3"
                    component="div"
                    sx={{ ml: theme.spacing(1) }}
                >
                    {lang.settings}
                </Typography>

        </Stack>
    );
}