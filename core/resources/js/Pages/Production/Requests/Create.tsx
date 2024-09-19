import React, { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Stack, Typography, useTheme } from '@mui/material';
import LanguageContext from '@/Contexts/LanguageContext';
import NavTabs from '@/Domains/Production/NavTabs';

export default function Create({ ...props } : any) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.requests}>
            <Stack
                sx={{

                    mb: theme.spacing(4)
                }}
            >
                <Typography variant="h3">Production</Typography>

                <NavTabs />
            </Stack>

        </DashboardLayout>
    );
}
