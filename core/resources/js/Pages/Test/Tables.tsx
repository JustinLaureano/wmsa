import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import { Card, CardContent, CardHeader, Stack, Typography, useTheme } from '@mui/material';
import HomeTabs from '@/Components/HomeTabs';
import DataTable from '@/Components/Tables/DataTable';

interface ViewTablesProps {
    containers: any
}

const columns = [
    { field: 'material_uuid', headerName: 'Material UUID' },
    { field: 'storage_location_uuid', headerName: 'Storage Location UUID' },
    { field: 'created_at', headerName: 'Created At' },
];

export default function ViewTables({ containers, ...props } : ViewTablesProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    console.log(containers)

    return (
        <DashboardLayout title={lang.inventory}>
            <Stack sx={{ mb: theme.spacing(4) }}>
                <Typography variant="h3">Test - Tables</Typography>

                <HomeTabs />
            </Stack>
            <Stack direction="row" spacing={4} sx={{ mb: 4 }}>
                <Card sx={{ flexGrow: 1 }}>
                    <CardHeader
                        title={'Materials'}
                    />
                    <CardContent>




                        <DataTable
                            columns={columns}
                            rows={containers.data}
                            pagination={containers}
                        />






                    </CardContent>
                </Card>
            </Stack>
        </DashboardLayout>
    );
}
