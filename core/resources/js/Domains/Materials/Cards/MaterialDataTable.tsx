import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import { MaterialDataTableProps } from '../types';
import { router } from '@inertiajs/react';
import MaterialNumberSearchFilter from '../Filters/MaterialNumberSearchFilter';
import PartNumberSearchFilter from '../Filters/PartNumberSearchFilter';

const columns = [
    { field: 'material_number', headerName: 'Material' },
    { field: 'part_number', headerName: 'Part' },
    { field: 'description', headerName: 'Description' },
    { field: 'base_unit_of_measure', headerName: 'UOM' },
];

const filters = [
    { component: MaterialNumberSearchFilter },
    { component: PartNumberSearchFilter },
];

export default function MaterialDataTable({ materials } : MaterialDataTableProps) {

    const handleFilterEvent = (filterParams) => {
        console.log(filterParams)
        console.log('handling filter event')

        router.get(route('materials'), filterParams, {
            only: ['materials']
        })
    }

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={'Materials'} />
            <CardContent>
                <DataTable
                    columns={columns}
                    rows={materials.data}
                    pagination={materials}
                    filters={filters}
                    onFilterEvent={handleFilterEvent}
                />
            </CardContent>
        </Card>
    )
}
