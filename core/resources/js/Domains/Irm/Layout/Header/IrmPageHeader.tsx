import { useContext } from 'react';
import { IrmPageHeaderProps } from '@/types';
import { Stack, Typography, useTheme } from '@mui/material';
import IrmNavTabs from '../Navigation/IrmNavTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function IrmPageHeader(props : IrmPageHeaderProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    return (
        <Stack sx={{ mb: theme.spacing(4) }}>
            <Typography variant="h3">{lang.irm}</Typography>

            <IrmNavTabs />
        </Stack>
    )
}
