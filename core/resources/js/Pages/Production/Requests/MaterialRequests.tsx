import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { MaterialRequestListCollection } from '@/types/requests';
import { Card, CardContent, CardHeader, Stack, Typography, Box } from '@mui/material';

interface MaterialRequestsProps {
    requests: MaterialRequestListCollection;
}

export default function MaterialRequests({ requests } : MaterialRequestsProps) {
    const { lang } = useContext(LanguageContext);
    const list = requests.data;

    console.log(list);

    return (
        <SidebarLayout title={lang.requests}>
            <ProductionPageHeader />

            <Stack spacing={2}>
                {list.map((request) => {
                    return (
                        <Card key={request.uuid}>
                            <CardHeader title={request.computed.title} />
                            <CardContent>
                                <Stack direction="row" justifyContent="space-between">
                                    <Box>
                                        <Typography variant="h6">Preferred Material</Typography>
                                        {
                                            request.relations.container_allocation && (
                                                <Stack>
                                                    <Typography variant="body1">Qty: {request.relations.container_allocation.quantity}</Typography>
                                                    <Typography variant="body1">Lot: {request.relations.container_allocation.lot_number}</Typography>
                                                    <Typography variant="body1">Container: {request.relations.container_allocation.container_type.name}</Typography>
                                                </Stack>
                                            )
                                        }
                                    </Box>
                                </Stack>


                                {/* <Typography variant="h6">{request.computed.title}</Typography>
                                <p>{request.computed.material_part_number}</p>
                                <p>{request.computed.material_description}</p>
                                <p>{request.computed.machine_name}</p>
                                <p>{request.computed.storage_location_name}</p>
                                <p>{request.computed.requester_name}</p>
                                <p>{request.computed.requested_at}</p>
                                <p>{request.computed.status}</p> */}
                            </CardContent>
                        </Card>
                    );
                })}
            </Stack>

        </SidebarLayout>
    );
}
