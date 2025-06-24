import { useContext } from 'react';
import { Stack, Typography, useTheme } from '@mui/material';
import ShippingNavTabs from '../Navigation/ShippingNavTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function ShippingPageHeader() {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.shipping}</Typography>

            <ShippingNavTabs />
        </Stack>
    )
}
