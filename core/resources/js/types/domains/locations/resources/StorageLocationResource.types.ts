import { JsonApiResource, JsonObject, MaterialContainerResource } from "@/types";

export interface StorageLocationResourceAttributes {
    name: string;
    barcode: string;
    storage_location_type_id: string;
    storage_location_area_id: string;
    aisle: number;
    bay: number;
    shelf: number;
    position: number;
    max_containers: number;
    restrict_request_allocations: boolean;
    disabled: boolean;
    reservable: boolean;
}

export interface StorageLocationResourceRelations {
    area: JsonObject;
    containers: MaterialContainerResource[];
    type: JsonObject;
}

export interface StorageLocationResourceComputed {
    container_count: number;
    location_type: string;
    maximum_container_count: string | number;
}

export type StorageLocationResource = JsonApiResource<
    StorageLocationResourceAttributes,
    StorageLocationResourceRelations,
    StorageLocationResourceComputed
>;
