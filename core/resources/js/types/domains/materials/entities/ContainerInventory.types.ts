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