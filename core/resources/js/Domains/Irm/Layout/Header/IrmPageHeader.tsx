import { IrmPageHeaderProps } from '@/types';
import { Stack, Typography, useTheme } from '@mui/material';
import IrmNavTabs from '../Navigation/IrmNavTabs';

export default function IrmPageHeader(props : IrmPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">IRM</Typography>

            <IrmNavTabs />
        </Stack>
    )
}
