import { useState } from 'react';
import axios from 'axios';
import { ContainerInventoryDataTableProps, JsonObject, RenderCellParams } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import MaterialSearchFilter from '../Filters/MaterialSearchFilter';
import MaterialNumberSearchFilter from '../Filters/MaterialNumberSearchFilter';
import PartNumberSearchFilter from '../Filters/PartNumberSearchFilter';
import LotNumberFilter from '../Filters/LotNumberFilter';
import PrimaryLink from '@/Components/Shared/PrimaryLink';

const MaterialNumberCell = (params : RenderCellParams) => {
    return (
        <PrimaryLink
            route={route('materials.show', { material: params.row.material_uuid })}
            label={params.value}
        />
    )
}

const columns = (lang: JsonObject) => {
    return [
        { field: 'material_number', headerName: lang.material, renderCell: MaterialNumberCell },
        { field: 'part_number', headerName: lang.part },
        { field: 'lot_number', headerName: lang.lot },
        { field: 'quantity', headerName: lang.quantity },
        { field: 'base_unit_of_measure', headerName: lang.uom },
        { field: 'expiration_date', headerName: lang.expiration_date },
        { field: 'container_type_name', headerName: lang.container_type },
        { field: 'storage_location_name', headerName: lang.storage_location },
        { field: 'movement_status_name', headerName: lang.movement_status },
    ];
}

const filters = [
    { component: MaterialSearchFilter },
    { component: MaterialNumberSearchFilter },
    { component: PartNumberSearchFilter },
    { component: LotNumberFilter },
];

export default function ContainerInventoryDataTable({ inventory } : ContainerInventoryDataTableProps) {
    const { lang } = useLanguage();

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
                    columns={columns(lang)}
                    rows={data.data}
                    pagination={data}
                    filters={filters}
                    onFilterEvent={handleFilterEvent}
                />
            </CardContent>
        </Card>
    )
}
