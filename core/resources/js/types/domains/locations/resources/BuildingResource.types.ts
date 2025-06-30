import { JsonApiResource, JsonObject } from "@/types";

export interface BuildingResourceAttributes {
    id: number;
    organization_id: number;
    building_type_id: number;
    name: string;
    location: string;
}

export interface BuildingResourceRelations {
    organization: JsonObject;
    type: JsonObject;
}

export interface BuildingResourceComputed {
    building_name: string;
    organization_name: string;
    type_name: string;
}

export type BuildingResource = JsonApiResource<
    BuildingResourceAttributes,
    BuildingResourceRelations,
    BuildingResourceComputed
>;
