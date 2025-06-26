import { Stack, Typography, useTheme } from '@mui/material';
import MaterialsNavTabs from '../Navigation/MaterialsNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function MaterialsPageHeader() {
    const { lang } = useLanguage();
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.materials}</Typography>

            <MaterialsNavTabs />
        </Stack>
    )
}
