import { useState } from 'react';
import axios from 'axios';
import { ViewIrmChemicalDataTableProps, JsonObject, RenderCellParams } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import IrmChemicalSearchFilter from '../Filters/IrmChemicalSearchFilter';
import PrimaryLink from '@/Components/Shared/PrimaryLink';

const PartNumberCell = (params : RenderCellParams) => {
    return (
        <PrimaryLink
            route={route('irm.chemicals.show', { chemical: params.row.uuid })}
            label={params.value}
        />
    )
}

const columns = (lang: JsonObject) => {
    return [
        { field: 'part_number', headerName: lang.part_number, renderCell: PartNumberCell },
        { field: 'lot_quantity', headerName: lang.lot_quantity },
        { field: 'unit_quantity', headerName: lang.unit_quantity },
        { field: 'base_unit_of_measure', headerName: lang.uom },
        { field: 'material_container_type', headerName: lang.container },
        { field: 'assigned_storage_location_name', headerName: lang.assigned_location },
        { field: 'drop_off_storage_location_name', headerName: lang.drop_off_location },
    ];
}

const filters = [
    { component: IrmChemicalSearchFilter },
];

export default function ViewIrmChemicalDataTable({ chemicals } : ViewIrmChemicalDataTableProps) {
    const { lang } = useLanguage();

    const [data, setData] = useState(chemicals);

    const handleFilterEvent = (filterParams: JsonObject) => {
        axios.get(route('irm.chemicals'), { params: filterParams })
            .then(res => setData(res.data))
    }

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.irm_chemicals} />
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
