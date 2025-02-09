import React, { useContext, useEffect } from 'react';
import { router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Box, Card, CardContent, CardHeader, Divider, Stack, Typography, useTheme, Button } from '@mui/material';
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
        <DashboardLayout title={lang.home}>

            <Stack
                sx={{

                    mb: theme.spacing(4)
                }}
            >
                <Typography variant="h3">Home</Typography>

                <HomeTabs />
            </Stack>

            <Stack spacing={2}>
                <Card variant="outlined" sx={{ flexGrow: 1 }}>
                    <CardHeader
                        title={'Company Profile'}
                    />
                    <CardContent>
                        <Typography variant="h1">H1: Company Profile</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="h2">H2: System Settings</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="h3">H3: Completed Tasks</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="h4">H4: Sales by Country</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="h5">H5: Exploring the Impact of Artificial Intelligence on Modern Healthcare</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="h6">H6: The Future of Renewable Energy: Innovations and Challenges Ahead</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="subtitle1">Subtitle 1: The Future of Renewable Energy: Innovations and Challenges Ahead</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="subtitle2">Subtitle 2: The Future of Renewable Energy: Innovations and Challenges Ahead</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="body1">body1: The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="body2">body2: The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="button">button: Create</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="caption">caption: The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.</Typography>
                        <Divider sx={{ my: 2 }} />
                        <Typography variant="overline">overline: The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.</Typography>
                        <Divider sx={{ my: 2 }} />
                    </CardContent>
                </Card>

                <Card variant="outlined" sx={{ flexGrow: 1 }}>
                    <CardHeader
                        title={'Form Control'}
                    />
                    <CardContent>
                        <Stack direction="row" spacing={2}>
                            <Button variant="contained" color="primaryText">Default T</Button>
                            <Button variant="contained" color="secondaryText">Secondary T</Button>
                            <Button variant="contained" color="primary">Primary</Button>
                            <Button variant="contained" color="secondary">Secondary</Button>
                            <Button variant="contained" color="success">Success</Button>
                            <Button variant="contained" color="error">Error</Button>
                            <Button variant="contained" color="info">Info</Button>
                            <Button variant="contained" color="warning">Warning</Button>
                        </Stack>

                        <Stack direction="row" spacing={2} mt={2}>
                            <Button variant="outlined" color="primaryText">Default T</Button>
                            <Button variant="outlined" color="secondaryText">Secondary T</Button>
                            <Button variant="outlined" color="primary">Primary</Button>
                            <Button variant="outlined" color="secondary">Secondary</Button>
                            <Button variant="outlined" color="success">Success</Button>
                            <Button variant="outlined" color="error">Error</Button>
                            <Button variant="outlined" color="info">Info</Button>
                            <Button variant="outlined" color="warning" size="small">Warning</Button>
                        </Stack>
                    </CardContent>
                </Card>
            </Stack>
        </DashboardLayout>
    );
}
