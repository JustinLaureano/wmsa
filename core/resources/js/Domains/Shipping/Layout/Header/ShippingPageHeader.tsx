import { Stack, Typography, useTheme } from '@mui/material';
import ShippingNavTabs from '../Navigation/ShippingNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function ShippingPageHeader() {
    const theme = useTheme();
    const { lang } = useLanguage();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.shipping}</Typography>

            <ShippingNavTabs />
        </Stack>
    )
}
