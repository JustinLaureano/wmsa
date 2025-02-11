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

            <Stack spacing={2} sx={{
                maxWidth: '1000px',
                margin: '0 auto',
            }}>
                {list.map((request) => {
                    return (
                        <Card key={request.uuid}>
                            <CardHeader title={request.title} />
                            <CardContent>
                                <Stack direction="row" justifyContent="space-between">
                                    <Box>
                                        <Typography variant="h6">Items</Typography>
                                        {
                                            request.items.map((item) => {
                                                return (
                                                    <Box key={item.uuid} sx={{ mt: 1 }}>
                                                        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
                                                            <tbody>
                                                                <tr>
                                                                    <td style={{ padding: '4px 8px' }}>{item.material_part_number}</td>
                                                                    <td style={{ padding: '4px 8px' }}>{item.machine_name || item.storage_location_name}</td>
                                                                    <td style={{ padding: '4px 8px' }}>
                                                                        {item.quantity_delivered} / {item.quantity_requested} {item.unit_of_measure}
                                                                    </td>
                                                                    <td style={{ padding: '4px 8px' }}>
                                                                        {item.container_allocation?.location || '-na'}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </Box>
                                                );
                                            })
                                        }
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
