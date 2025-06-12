import { JsonApiResource } from "@/types";

export interface StorageLocationTypeResourceAttributes {
    id: number;
    name: string;
    description: string;
    default_max_containers: number;
}

export interface StorageLocationTypeResourceRelations {
    //
}

export interface StorageLocationTypeResourceComputed {
    storage_location_areas_count: number;
}

export type StorageLocationTypeResource = JsonApiResource<
    StorageLocationTypeResourceAttributes,
    StorageLocationTypeResourceRelations,
    StorageLocationTypeResourceComputed
>;
