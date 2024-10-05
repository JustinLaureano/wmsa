import { Pagination } from "@/Components/Tables/types";

export interface Material {
    id: number;
    uuid: string;
    part_number: string;
    description: string;
    base_quantity: number;
    base_unit_of_measure: string;
}

export interface MaterialPagination extends Pagination {
    data: Material[];
}

export interface ViewMaterialsProps {
    materials: MaterialPagination;
}

export interface MaterialDataTableProps {
    materials: MaterialPagination;
}

export interface MaterialSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}

export interface MaterialNumberSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}

export interface PartNumberSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}
