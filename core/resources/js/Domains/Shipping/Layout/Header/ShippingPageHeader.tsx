import { Stack, Typography, useTheme } from '@mui/material';
import ShippingNavTabs from '../Navigation/ShippingNavTabs';

interface ShippingPageHeaderProps {}

export default function ShippingPageHeader(props : ShippingPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Shipping</Typography>

            <ShippingNavTabs />
        </Stack>
    )
}
