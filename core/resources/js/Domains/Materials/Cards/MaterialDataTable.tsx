import { useState } from 'react';
import axios from 'axios';
import { MaterialDataTableProps, JsonObject, RenderCellParams } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import MaterialSearchFilter from '../Filters/MaterialSearchFilter';
import MaterialNumberSearchFilter from '../Filters/MaterialNumberSearchFilter';
import PartNumberSearchFilter from '../Filters/PartNumberSearchFilter';
import PrimaryLink from '@/Components/Shared/PrimaryLink';

const MaterialLinkCell = (params : RenderCellParams) => {
    return (
        <PrimaryLink
            route={route('materials.show', { material: params.row.uuid })}
            label={params.value}
        />
    )
}

const columns = (lang: JsonObject) => {
    return [
        { field: 'material_number', headerName: lang.material, renderCell: MaterialLinkCell },
        { field: 'part_number', headerName: lang.part, renderCell: MaterialLinkCell },
        { field: 'description', headerName: lang.description },
        { field: 'base_unit_of_measure', headerName: lang.uom },
    ];
}

const filters = [
    { component: MaterialSearchFilter },
    { component: MaterialNumberSearchFilter },
    { component: PartNumberSearchFilter },
];

export default function MaterialDataTable({ materials } : MaterialDataTableProps) {
    const { lang } = useLanguage();

    const [data, setData] = useState(materials);

    const handleFilterEvent = (filterParams: JsonObject) => {
        axios.get(route('materials'), { params: filterParams })
            .then(res => setData(res.data))
    }

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.materials} />
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
