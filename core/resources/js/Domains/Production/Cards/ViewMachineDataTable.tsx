import { useState } from 'react';
import axios from 'axios';
import { ViewMachineDataTableProps, JsonObject, RenderCellParams } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import MachineSearchFilter from '../Filters/MachineSearchFilter';
import PrimaryLink from '@/Components/Shared/PrimaryLink';
import { collectionPaginationToPagination } from '@/Utils/pagination';

const MachineNameCell = (params : RenderCellParams) => {
    return (
        <PrimaryLink
            route={route('machines.show', { machine: params.row.uuid })}
            label={params.value}
        />
    )
}

const columns = (lang: JsonObject) => {
    return [
        { field: 'machine_name', headerName: lang.name, renderCell: MachineNameCell },
        { field: 'building_name', headerName: lang.building },
        { field: 'machine_type_label', headerName: lang.machine_type },
        { field: 'barcode', headerName: lang.barcode },
    ];
}

const filters = [
    { component: MachineSearchFilter },
];

export default function ViewMachineDataTable({ machines } : ViewMachineDataTableProps) {
    const { lang } = useLanguage();

    const [data, setData] = useState( collectionPaginationToPagination(machines) );

    const handleFilterEvent = (filterParams: JsonObject) => {
        axios.get(route('machines'), { params: filterParams })
            .then(res => setData(collectionPaginationToPagination(res.data)))
    }

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.machines} />
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
