import { Stack, Typography, useTheme } from '@mui/material';
import LocationsNavTabs from '../Navigation/LocationsNavTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function LocationsPageHeader() {
    const { lang } = useLanguage();
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">
                {lang.locations}
            </Typography>

            <LocationsNavTabs />
        </Stack>
    )
}
