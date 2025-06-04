export interface MaterialContainerResource {
    uuid: string;
    material_uuid: string;
    material_container_type_id: number|null;
    material_tote_type_uuid: string|null;
    movement_status_code: string;
    barcode: string;
    lot_number: string|null;
    quantity: number;
    expiration_date: string;
}