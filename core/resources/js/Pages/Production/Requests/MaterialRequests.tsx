import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { MaterialRequestListCollection } from '@/types/requests';
import {
    Card,
    CardContent,
    CardHeader,
    Stack,
    Typography,
    Box,
    Table,
    TableBody,
    TableRow,
    TableCell,
    TableHead,
} from '@mui/material';

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

            <Stack spacing={2} sx={{
                maxWidth: '1000px',
                margin: '0 auto',
            }}>
                {list.map((request) => {
                    return (
                        <Card key={request.uuid}>
                            <CardHeader title={request.title} />
                            <CardContent>
                                <Stack justifyContent="space-between">
                                    <Box>
                                        <Typography variant="body2">Requester: {request.requester_name}</Typography>
                                        <Typography variant="body2">Requested: {request.requested_at}</Typography>
                                        <Typography variant="body2">Status: {request.status}</Typography>
                                    </Box>
                                    <Box sx={{ width: '100%', mt: 2 }}>
                                        <Typography variant="h6">Items</Typography>
                                        {request.items.map((item) => {
                                            return (
                                                <Box key={item.uuid}>
                                                    <Table size="small">
                                                        <TableHead>
                                                            <TableRow>
                                                                <TableCell>Part Number</TableCell>
                                                                <TableCell>Location</TableCell>
                                                                <TableCell>Quantity</TableCell>
                                                                <TableCell>Container</TableCell>
                                                            </TableRow>
                                                        </TableHead>
                                                        <TableBody>
                                                            <TableRow>
                                                                <TableCell>{item.material_part_number}</TableCell>
                                                                <TableCell>{item.machine_name || item.storage_location_name}</TableCell>
                                                                <TableCell>
                                                                    {item.quantity_delivered} / {item.quantity_requested} {item.unit_of_measure}
                                                                </TableCell>
                                                                <TableCell>
                                                                    {item.container_allocation?.location || '-na'}
                                                                </TableCell>
                                                            </TableRow>
                                                        </TableBody>
                                                    </Table>
                                                </Box>
                                            );
                                        })}
                                    </Box>
                                </Stack>

                            </CardContent>
                        </Card>
                    );
                })}
            </Stack>

        </SidebarLayout>
    );
}
