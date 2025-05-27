import { Pagination } from "@/Components/Tables/types";

export interface Material {
    id: number;
    uuid: string;
    material_number?: string;
    part_number: string;
    description: string;
    material_type_code: string|null;
    base_quantity: number;
    base_unit_of_measure: string;
}

export interface Inventory {
    id: number;
    uuid: string;
    material_uuid: string;
    barcode: string;
    lot_number: string;
    quantity: number;
    expiration_date: string;
    material_number: string;
    part_number: string;
    material_description: string;
    base_unit_of_measure: string;
    container_type_name: string;
    movement_status_name: string;
    storage_location_name: string;
}

export interface MaterialPagination extends Pagination {
    data: Material[];
}

export interface InventoryPagination extends Pagination {
    data: Inventory[];
}

export interface ViewMaterialsProps {
    materials: MaterialPagination;
}

export interface ShowInventoryProps {
    inventory: InventoryPagination;
}

export interface ShowMaterialProps {
    material: Material;
}

export interface MaterialDataTableProps {
    materials: MaterialPagination;
}

export interface InventoryDataTableProps {
    inventory: InventoryPagination;
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

export interface LotNumberFilterProps {
    onFilterChange: (field: string, value: string) => void;
}