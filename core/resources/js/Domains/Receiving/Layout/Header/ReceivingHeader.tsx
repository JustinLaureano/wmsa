import { Stack, Typography, useTheme } from '@mui/material';
import ReceivingNavTabs from '../Navigation/ReceivingNavTabs';

export default function ReceivingPageHeaderHeader() {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Receiving</Typography>

            <ReceivingNavTabs />
        </Stack>
    )
}
