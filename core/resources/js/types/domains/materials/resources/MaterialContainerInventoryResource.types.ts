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