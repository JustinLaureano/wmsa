import { Stack, Typography, useTheme } from '@mui/material';
import QualityNavTabs from '../Navigation/QualityNavTabs';

export default function QualityPageHeader() {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Quality</Typography>

            <QualityNavTabs />
        </Stack>
    )
}
