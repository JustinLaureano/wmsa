import { Stack, Typography, useTheme } from '@mui/material';
import LocationsNavTabs from '../Navigation/LocationsNavTabs';

interface LocationsPageHeaderProps {}

export default function LocationsPageHeader(props : LocationsPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Locations</Typography>

            <LocationsNavTabs />
        </Stack>
    )
}
