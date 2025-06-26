import { Stack, Typography, useTheme } from '@mui/material';
import ProductionNavTabs from '../Navigation/ProductionNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function ProductionPageHeader() {
    const { lang } = useLanguage();
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.production}</Typography>

            <ProductionNavTabs />
        </Stack>
    )
}
