import { useContext, useState } from 'react';
import { Link } from '@inertiajs/react';
import axios from 'axios';
import { ContainerInventoryDataTableProps, JsonObject, RenderCellParams } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import MaterialSearchFilter from '../Filters/MaterialSearchFilter';
import MaterialNumberSearchFilter from '../Filters/MaterialNumberSearchFilter';
import PartNumberSearchFilter from '../Filters/PartNumberSearchFilter';
import LotNumberFilter from '../Filters/LotNumberFilter';

const MaterialNumberCell = (params : RenderCellParams) => {
    return (
        <Link href={route('materials.show', { material: params.row.material_uuid })}>
            {params.value}
        </Link>
    )
}

const columns = [
    { field: 'material_number', headerName: 'Material', renderCell: MaterialNumberCell },
    { field: 'part_number', headerName: 'Part' },
    { field: 'lot_number', headerName: 'Lot' },
    { field: 'quantity', headerName: 'Quantity' },
    { field: 'base_unit_of_measure', headerName: 'UOM' },
    { field: 'expiration_date', headerName: 'Expiration Date' },
    { field: 'container_type_name', headerName: 'Container Type' },
    { field: 'storage_location_name', headerName: 'Storage Location' },
    { field: 'movement_status_name', headerName: 'Movement Status' },
];

const filters = [
    { component: MaterialSearchFilter },
    { component: MaterialNumberSearchFilter },
    { component: PartNumberSearchFilter },
    { component: LotNumberFilter },
];

export default function ContainerInventoryDataTable({ inventory } : ContainerInventoryDataTableProps) {
    const { lang } = useContext(LanguageContext);

    const [data, setData] = useState(inventory);

    const handleFilterEvent = (filterParams: JsonObject) => {
        axios.get(route('containers.inventory'), { params: filterParams })
            .then(res => setData(res.data))
    }

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.inventory} />
            <CardContent>
                <DataTable
                    columns={columns}
                    rows={data.data}
                    pagination={data}
                    filters={filters}
                    onFilterEvent={handleFilterEvent}
                />
            </CardContent>
        </Card>
    )
}
