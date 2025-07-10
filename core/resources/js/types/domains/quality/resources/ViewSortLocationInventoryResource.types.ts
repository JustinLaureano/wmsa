import { MaterialBarcodeResource } from '@/types';

export interface ViewSortLocationInventoryResource {
    material_container_uuid: string;
    material_uuid: string;
    barcode: string;
    barcode_label: MaterialBarcodeResource;
    lot_number: string;
    quantity: number;
    quantity_edited?: boolean;
    quantity_updated?: boolean;
    part_number: string;
    movement_status_name: string;
    storage_location_building_id: number;
    storage_location_area_name: string;
    storage_location_name: string;
}