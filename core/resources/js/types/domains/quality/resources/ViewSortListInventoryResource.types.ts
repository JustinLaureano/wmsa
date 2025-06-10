export interface ViewSortListInventoryResource {
    material_container_uuid: string;
    material_uuid: string;
    barcode: string;
    lot_number: string;
    quantity: number;
    part_number: string;
    movement_status_name: string;
    storage_location_building_id: number;
    storage_location_area_name: string;
    storage_location_name: string;
}