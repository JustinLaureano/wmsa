import { Stack, Typography, useTheme } from '@mui/material';
import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';

export default function StoreContainerHeader() {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
            <NavigateBackLink
                route={route('production.put-away.scan')}
                label="Back to Scan"
            />

            <Typography variant="h3">Store Container</Typography>
        </Stack>
    )
}
