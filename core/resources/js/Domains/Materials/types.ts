import { Pagination } from "@/Components/Tables/types";

// moved
export interface Material {
    id: number;
    uuid: string;
    material_number?: string;
    part_number: string;
    description: string;
    material_type_code: string | null;
    base_quantity: number;
    base_unit_of_measure: string;
}

// moved
export interface ContainerInventory {
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

// moved
export interface MaterialInventoryCollection {
    data: MaterialInventoryResource[];
    computed: {
        count: number;
    };
    meta: {
        timestamp: string;
    };
}

// moved
export interface MaterialInventoryResource {
    uuid: string;
    attributes: {
        material_number: string;
        part_number: string;
        description: string;
        base_unit_of_measure: string;
        base_quantity: number;
    };
    relations: {
        containers: MaterialContainerInventoryResource[];
    };
    computed: {
        material_uuid: string;
        total_quantity: number;
        container_count: number;
        title: string;
    };
}

// moved
export interface MaterialContainerInventoryResource {
    uuid: string;
    attributes: {
        barcode: string;
        lot_number: string;
        quantity: number;
        expiration_date: string;
        movement_status_code: string;
    };
    computed: {
        barcode_label: {
            barcode: string;
            lot_number: string;
            quantity: number;
            expires_at: string;
        };
        movement_status: string;
        expires_at: string;
    };
}

// moved
export interface MaterialPagination extends Pagination {
    data: Material[];
}

// moved
export interface ContainerInventoryPagination extends Pagination {
    data: ContainerInventory[];
}

// moved
export interface MaterialInventoryPagination extends Pagination {
    data: MaterialInventoryCollection[];
}

// moved
export interface ViewMaterialsProps {
    materials: MaterialPagination;
}

// moved
export interface ShowContainerInventoryProps {
    inventory: ContainerInventoryPagination;
}

// moved
export interface ShowMaterialInventoryProps {
    inventory: MaterialInventoryPagination;
}

// moved
export interface ShowMaterialProps {
    material: Material;
}

// moved
export interface MaterialDataTableProps {
    materials: MaterialPagination;
}

// moved
export interface ContainerInventoryDataTableProps {
    inventory: ContainerInventoryPagination;
}

// moved
export interface MaterialSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}

// moved to SearchFilter.types.ts
export interface MaterialNumberSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}

// moved to SearchFilter.types.ts
export interface PartNumberSearchFilterProps {
    onFilterChange: (field: string, value: string) => void;
}

// moved to SearchFilter.types.ts
export interface LotNumberFilterProps {
    onFilterChange: (field: string, value: string) => void;
}