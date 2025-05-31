import { Stack } from '@mui/material';
import { DataTableFiltersProps } from '@/types';

export default function DataTableFilters({
    filters,
    onFilterRequest
} : DataTableFiltersProps) {

    const handleFilterChange = (field: string, operation: string, value: string) => {
        onFilterRequest(field, operation, value);
    }

    return (
        <Stack
            direction="row"
            alignItems="center"
            sx={{ p: 1 }}
            gap={2}
        >
            { filters.map((filter, index) => (
                <filter.component
                    key={index}
                    onFilterChange={handleFilterChange}
                />
            )) }
        </Stack>
    )
}
