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
                            <CardHeader title={request.title} />
                            <CardContent>
                                <Stack direction="row" justifyContent="space-between">
                                    <Box>
                                        <Typography variant="h6">Items</Typography>
                                        {
                                            request.items.map((item) => {
                                                return (
                                                    <Typography key={item.uuid} variant="body1">{item.material_part_number}</Typography>
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
