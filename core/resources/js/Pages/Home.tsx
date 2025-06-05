import React, { useContext, useEffect } from 'react';
import { router } from '@inertiajs/react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Box, Card, CardContent, CardHeader, Divider, Stack, Typography, useTheme, Button, TextField, Skeleton } from '@mui/material';
import { toast } from 'react-toastify';
import HomeTabs from '@/Components/HomeTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function Home({ recentRequests, ...props } : any) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    useEffect(() => {
        window.Echo.channel('request-created')
            .listen('.requests.created', (e: any) => {
                toast(`A new request has been created`);

                router.reload({ only: ['recentRequests'] })
            });

        return () => {
            window.Echo.leave('request-created')
        }
    }, [])

    return (
        <SidebarLayout title={lang.home}>

            <Stack
                sx={{
                    mb: theme.spacing(4)
                }}
            >
                <Typography variant="h3">Home</Typography>

                <HomeTabs />
            </Stack>

            <Stack direction="row" spacing={2}>
                <Skeleton variant="rectangular" width="33%" height={200} />
                <Skeleton variant="rectangular" width="33%" height={200} />
                <Skeleton variant="rectangular" width="33%" height={200} />
            </Stack>

            <Stack direction="row" spacing={2} sx={{ mt: 4 }}>
                <Skeleton variant="rectangular" width="50%" height={300} />
                <Skeleton variant="rectangular" width="50%" height={300} />
            </Stack>

            <Box sx={{ mt: 4 }}>
                <Skeleton variant="rectangular" height={300} />
            </Box>
        </SidebarLayout>
    );
}
