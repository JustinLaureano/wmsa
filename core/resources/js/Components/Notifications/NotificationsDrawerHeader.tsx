import { NotificationsDrawerHeaderProps } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Close } from '@mui/icons-material';
import { IconButton, Stack, Typography, useTheme } from '@mui/material';

export default function NotificationsDrawerHeader({ onCloseClick, ...props } : NotificationsDrawerHeaderProps) {
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
                    {lang.notifications}
                </Typography>

        </Stack>
    );
}
