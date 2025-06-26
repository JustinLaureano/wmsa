import { Stack, Typography, useTheme } from '@mui/material';
import QualityNavTabs from '../Navigation/QualityNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';
export default function QualityPageHeader() {
    const { lang } = useLanguage();
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.quality}</Typography>

            <QualityNavTabs />
        </Stack>
    )
}
