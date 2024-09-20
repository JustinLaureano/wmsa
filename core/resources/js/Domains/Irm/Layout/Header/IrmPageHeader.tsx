import { Stack, Typography, useTheme } from '@mui/material';
import IrmNavTabs from '../Navigation/IrmNavTabs';

interface IrmPageHeaderProps {}

export default function IrmPageHeader(props : IrmPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">IRM</Typography>

            <IrmNavTabs />
        </Stack>
    )
}
