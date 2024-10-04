import {
    Stack,
    useTheme
} from '@mui/material';
import { DataTableFiltersProps } from './types';
import TextSearchFilter from './TextSearchFilter';

export default function DataTableFilters({
    filters,
    onFilterRequest
} : DataTableFiltersProps) {
    const theme = useTheme();

    const handleFilterChange = (field: string, value: string) => {
        onFilterRequest(field, value);
    }

    return (
        <Stack
            direction="row"
            alignItems="center"
            sx={{ p: 1 }}
            gap={2}
        >
            <TextSearchFilter
                field={'material_uuid'}
                label={'Material UUID'}
                onFilterChange={handleFilterChange}
            />
        </Stack>
    )
}