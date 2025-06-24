import { useContext } from 'react';
import { Stack, Typography, useTheme } from '@mui/material';
import ReceivingNavTabs from '../Navigation/ReceivingNavTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function ReceivingPageHeaderHeader() {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.receiving}</Typography>

            <ReceivingNavTabs />
        </Stack>
    )
}
