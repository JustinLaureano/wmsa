export interface DataTableFiltersProps {
    filters: [];
    onFilterRequest: (field: string, value: string) => void;
}