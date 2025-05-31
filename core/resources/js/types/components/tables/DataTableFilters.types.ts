export interface DataTableFiltersProps {
    filters: any[];
    onFilterRequest: (field: string, operation: string, value: string) => void;
}
