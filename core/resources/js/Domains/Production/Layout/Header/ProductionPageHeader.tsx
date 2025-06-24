import { useContext } from 'react';
import { Stack, Typography, useTheme } from '@mui/material';
import ProductionNavTabs from '../Navigation/ProductionNavTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function ProductionPageHeader() {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.production}</Typography>

            <ProductionNavTabs />
        </Stack>
    )
}
