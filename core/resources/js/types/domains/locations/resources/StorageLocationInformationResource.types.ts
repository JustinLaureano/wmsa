export interface StorageLocationInformationResource {
    uuid: string;
    name: string;
    barcode: string;
    storage_location_type_id: number;
    storage_location_area_id: number;
    aisle: number;
    bay: number;
    shelf: number;
    position: number;
    max_containers: number;
    restrict_request_allocations: number;
    disabled: number;
    reservable: number;
}
