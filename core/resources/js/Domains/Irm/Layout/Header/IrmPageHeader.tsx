import { IrmPageHeaderProps } from '@/types';
import { Stack, Typography, useTheme } from '@mui/material';
import IrmNavTabs from '../Navigation/IrmNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function IrmPageHeader(props : IrmPageHeaderProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.irm}</Typography>

            <IrmNavTabs />
        </Stack>
    )
}
