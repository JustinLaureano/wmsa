import { Stack, Typography, useTheme } from '@mui/material';
import ReceivingNavTabs from '../Navigation/ReceivingNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function ReceivingPageHeaderHeader() {
    const theme = useTheme();
    const { lang } = useLanguage();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.receiving}</Typography>

            <ReceivingNavTabs />
        </Stack>
    )
}
