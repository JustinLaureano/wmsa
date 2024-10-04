export interface DataTableFiltersProps {
    filters: any[];
    onFilterRequest: (field: string, value: string) => void;
}
