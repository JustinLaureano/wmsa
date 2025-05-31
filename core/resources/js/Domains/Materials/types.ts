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

export interface MaterialInventoryCollection {
    data: MaterialInventoryResource[];
    computed: {
        count: number;
    };
    meta: {
        timestamp: string;
    };
}

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

export interface MaterialPagination extends Pagination {
    data: Material[];
}

export interface ContainerInventoryPagination extends Pagination {
    data: ContainerInventory[];
}

export interface MaterialInventoryPagination extends Pagination {
    data: MaterialInventoryCollection[];
}

export interface ViewMaterialsProps {
    materials: MaterialPagination;
}

export interface ShowContainerInventoryProps {
    inventory: ContainerInventoryPagination;
}

export interface ShowMaterialInventoryProps {
    inventory: MaterialInventoryPagination;
}

export interface ShowMaterialProps {
    material: Material;
}

export interface MaterialDataTableProps {
    materials: MaterialPagination;
}

export interface ContainerInventoryDataTableProps {
    inventory: ContainerInventoryPagination;
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