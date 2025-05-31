// Used for custom search filter components
export interface TextSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}

// Used for base text search filter component
export interface BaseTextSearchFilterProps {
    field: string;
    label?: string;
    operation?: string;
    placeholder?: string;
    onFilterChange: (field: string, operation: string, value: string) => void;
}