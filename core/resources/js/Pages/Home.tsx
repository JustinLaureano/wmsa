import React, { useEffect } from 'react';
import { Head, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Box, Card, CardContent, CardHeader, Stack, Typography } from '@mui/material';
import { toast } from 'react-toastify';
import RequestForm from '@/Domains/Requests/Components/RequestForm';

export default function Home({ recentRequests, ...props } : any) {

    console.log(recentRequests)

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
        <DashboardLayout>
            <Head title="Home" />

            <Stack direction="row" spacing={2} sx={{ mb: 4 }}>
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
                    />
                    <CardContent>
                    {
                        recentRequests.data.slice(0, 5).map((request : Record<string, any>) => (
                            <Box>
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
                {['Shipping', 'Sort', 'Materials'].map((title, index) => (
                    <Card key={index} sx={{ flexGrow: 1 }}>
                        <CardHeader
                            title={title}
                        />
                        <CardContent>
                            <Typography>
                                blah blah blah
                            </Typography>
                        </CardContent>
                    </Card>
                ))}
            </Stack>
        </DashboardLayout>
    );
}
