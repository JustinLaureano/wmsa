import { Stack, Typography, useTheme } from '@mui/material';
import LocationsNavTabs from '../Navigation/LocationsNavTabs';

export default function LocationsPageHeader() {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Locations</Typography>

            <LocationsNavTabs />
        </Stack>
    )
}
