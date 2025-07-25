import { SettingsHeaderProps } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Close } from '@mui/icons-material';
import { IconButton, Stack, Typography, useTheme } from '@mui/material';

export default function SettingsHeader({ onCloseClick, ...props } : SettingsHeaderProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

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
