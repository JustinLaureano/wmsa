import React, { useEffect } from 'react';
import { router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Box, Card, CardContent, CardHeader, Divider, Stack, Typography, useTheme } from '@mui/material';
import { toast } from 'react-toastify';
import RequestForm from '@/Domains/Requests/Components/RequestForm';
import HomeTabs from '@/Components/HomeTabs';

export default function Home({ recentRequests, ...props } : any) {
    // console.log(recentRequests)
    const theme = useTheme();

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
        <DashboardLayout title="Home">

            <Stack
                sx={{

                    mb: theme.spacing(4)
                }}
            >
                <Typography variant="h3">Production</Typography>

                <HomeTabs />
            </Stack>


            <Stack direction="row" spacing={4} sx={{ mb: 4 }}>
                <Card sx={{ flexGrow: 1 }}>
                    <CardHeader
                        title={'New Request'}
                    />
                    <CardContent>
                        <RequestForm />
                    </CardContent>
                </Card>

                <Card sx={{ flexGrow: 1 }}>
                    <CardHeader
                        title={"Recent"}
                        subheader="past 15 minutes"
                    />
                    <CardContent>
                    {
                        recentRequests.data.slice(0, 5).map((request : Record<string, any>) => (
                            <Box key={request.id}>
                                <Typography>
                                    {request.id} - Part: {request.part_id} - Location: {request.location_id}
                                </Typography>
                            </Box>
                        ))
                    }
                    </CardContent>
                </Card>
            </Stack>

            <Stack direction="row" spacing={2}>
                {['Shipping', 'Sort'].map((title, index) => (
                    <Card key={index} sx={{ flexGrow: 1 }}>
                        <CardHeader
                            title={title}
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
                            <Typography variant="body1">body1: The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.</Typography>
                            <Divider sx={{ my: 2 }} />
                            <Typography variant="body2">body2: blah blah blah</Typography>
                            <Divider sx={{ my: 2 }} />
                            <Typography variant="button">button: blah blah blah</Typography>
                            <Divider sx={{ my: 2 }} />
                        </CardContent>
                    </Card>
                ))}
            </Stack>
        </DashboardLayout>
    );
}
