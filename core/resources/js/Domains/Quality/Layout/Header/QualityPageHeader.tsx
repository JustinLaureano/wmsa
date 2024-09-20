import { Stack, Typography, useTheme } from '@mui/material';
import QualityNavTabs from '../Navigation/QualityNavTabs';

interface QualityPageHeaderProps {}

export default function QualityPageHeader(props : QualityPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Quality</Typography>

            <QualityNavTabs />
        </Stack>
    )
}
