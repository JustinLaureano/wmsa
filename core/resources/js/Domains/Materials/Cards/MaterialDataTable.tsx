import { useContext, useState } from 'react';
import axios from 'axios';
import { MaterialDataTableProps } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import MaterialSearchFilter from '../Filters/MaterialSearchFilter';
import MaterialNumberSearchFilter from '../Filters/MaterialNumberSearchFilter';
import PartNumberSearchFilter from '../Filters/PartNumberSearchFilter';

const columns = [
    { field: 'material_number', headerName: 'Material' },
    { field: 'part_number', headerName: 'Part' },
    { field: 'description', headerName: 'Description' },
    { field: 'base_unit_of_measure', headerName: 'UOM' },
];

const filters = [
    { component: MaterialSearchFilter },
    { component: MaterialNumberSearchFilter },
    { component: PartNumberSearchFilter },
];

export default function MaterialDataTable({ materials } : MaterialDataTableProps) {
    const { lang } = useContext(LanguageContext);

    const [data, setData] = useState(materials);

    const handleFilterEvent = (filterParams: Record<string, any>) => {
        axios.get(route('materials'), { params: filterParams })
            .then(res => setData(res.data))
    }

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.materials} />
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
