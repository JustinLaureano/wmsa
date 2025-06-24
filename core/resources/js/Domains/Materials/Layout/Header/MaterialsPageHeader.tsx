import { useContext } from 'react';
import { Stack, Typography, useTheme } from '@mui/material';
import MaterialsNavTabs from '../Navigation/MaterialsNavTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function MaterialsPageHeader() {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.materials}</Typography>

            <MaterialsNavTabs />
        </Stack>
    )
}
