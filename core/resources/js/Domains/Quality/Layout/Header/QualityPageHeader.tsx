import { useContext } from 'react';
import { Stack, Typography, useTheme } from '@mui/material';
import QualityNavTabs from '../Navigation/QualityNavTabs';
import LanguageContext from '@/Contexts/LanguageContext';
export default function QualityPageHeader() {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.quality}</Typography>

            <QualityNavTabs />
        </Stack>
    )
}
