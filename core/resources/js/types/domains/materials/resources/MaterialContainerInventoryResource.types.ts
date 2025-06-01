import { MaterialBarcodeLabel } from "./MaterialBarcodeLabel.types";

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
        barcode_label: MaterialBarcodeLabel;
        movement_status: string;
        expires_at: string;
        storage_location_uuid: string;
        storage_location_name: string;
        storage_location_barcode: string;
        container_type: string;
        container_type_name: string;
    };
}