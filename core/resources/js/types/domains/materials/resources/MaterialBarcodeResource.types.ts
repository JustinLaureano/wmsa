export interface MaterialBarcodeResource {
    barcode: string;
    barcode_type: string;
    barcode_hash: string;
    clock_number: string;
    expiration_date: string;
    expires_at: string;
    lot_number: string|null;
    manufacture_date: string;
    manufactured_at: string;
    part_number: string;
    quantity: number;
    serial_number: string;
    supplier: string;
    supplier_part_number: string;
    time: string;
}