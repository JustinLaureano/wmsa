import { JsonApiResource, JsonObject } from "@/types";

export interface StorageLocationAreaResourceAttributes {
    id: number;
    building_id: number;
    name: string;
    description: string;
    sap_storage_location_group: string;
}

export interface StorageLocationAreaResourceRelations {
    building: JsonObject;
}

export interface StorageLocationAreaResourceComputed {
    building_name: string;
}

export type StorageLocationAreaResource = JsonApiResource<
    StorageLocationAreaResourceAttributes,
    StorageLocationAreaResourceRelations,
    StorageLocationAreaResourceComputed
>;
