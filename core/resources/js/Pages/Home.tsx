import { useEffect } from 'react';
import { router } from '@inertiajs/react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Stack, Typography, useTheme } from '@mui/material';
import { toast } from 'react-toastify';
import HomeTabs from '@/Components/HomeTabs';
import { useLanguage } from '@/Providers/LanguageProvider';
import SkeletonPage from '@/Components/SkeletonPage';

export default function Home({ recentRequests, ...props } : any) {
    const theme = useTheme();
    const { lang } = useLanguage();

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
                <Typography variant="h3">{lang.home}</Typography>

                <HomeTabs />
            </Stack>
            
            <SkeletonPage />

        </SidebarLayout>
    );
}
