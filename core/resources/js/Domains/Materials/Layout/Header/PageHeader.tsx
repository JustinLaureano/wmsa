import { Stack, Typography, useTheme } from '@mui/material';
import NavTabs from '../Navigation/NavTabs';

interface PageHeaderProps {}

export default function PageHeader(props : PageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack
            sx={{ mb: theme.spacing(4) }}
        >
            <Typography variant="h3">Materials</Typography>

            <NavTabs />
        </Stack>
    )
}
