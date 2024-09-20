import { Stack, Typography, useTheme } from '@mui/material';
import MaterialsNavTabs from '../Navigation/MaterialsNavTabs';

interface MaterialsPageHeaderProps {}

export default function MaterialsPageHeader(props : MaterialsPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Materials</Typography>

            <MaterialsNavTabs />
        </Stack>
    )
}
