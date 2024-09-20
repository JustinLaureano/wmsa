import { Stack, Typography, useTheme } from '@mui/material';
import ProductionNavTabs from '../Navigation/ProductionNavTabs';

interface ProductionPageHeaderProps {}

export default function ProductionPageHeader(props : ProductionPageHeaderProps) {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">Production</Typography>

            <ProductionNavTabs />
        </Stack>
    )
}
