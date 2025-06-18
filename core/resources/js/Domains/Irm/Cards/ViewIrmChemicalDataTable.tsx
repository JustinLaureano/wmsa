import { useContext, useState } from 'react';
import axios from 'axios';
import { ViewIrmChemicalDataTableProps, JsonObject } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import { Card, CardContent, CardHeader } from '@mui/material';
import DataTable from '@/Components/Tables/DataTable';
import IrmChemicalSearchFilter from '../Filters/IrmChemicalSearchFilter';

const columns = [
    { field: 'part_number', headerName: 'Part' },
    { field: 'lot_quantity', headerName: 'Lot Qty' },
    { field: 'unit_quantity', headerName: 'Unit Qty' },
    { field: 'base_unit_of_measure', headerName: 'UOM' },
    { field: 'material_container_type', headerName: 'Container' },
    { field: 'assigned_storage_location_name', headerName: 'Assigned Location' },
    { field: 'drop_off_storage_location_name', headerName: 'Drop Off Location' },
];

const filters = [
    { component: IrmChemicalSearchFilter },
];

export default function ViewIrmChemicalDataTable({ chemicals } : ViewIrmChemicalDataTableProps) {
    const { lang } = useContext(LanguageContext);

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
