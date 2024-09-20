import { Stack, Typography, useTheme } from '@mui/material';
import ReceivingNavTabs from '../Navigation/ReceivingNavTabs';

interface ReceivingPageHeaderHeaderProps {}

export default function ReceivingPageHeaderHeader(props : ReceivingPageHeaderHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Receiving</Typography>

            <ReceivingNavTabs />
        </Stack>
    )
}
