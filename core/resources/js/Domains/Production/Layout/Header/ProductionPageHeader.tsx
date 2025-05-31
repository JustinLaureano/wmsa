import { Stack, Typography, useTheme } from '@mui/material';
import ProductionNavTabs from '../Navigation/ProductionNavTabs';

export default function ProductionPageHeader() {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Production</Typography>

            <ProductionNavTabs />
        </Stack>
    )
}
