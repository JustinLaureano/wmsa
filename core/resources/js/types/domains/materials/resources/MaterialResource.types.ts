import { JsonApiResource, JsonObject } from "@/types";

export interface MaterialResourceAttributes {
    uuid: string;
    material_number: string;
    part_number: string;
    description: string;
    material_type_code: string;
    base_quantity: number;
    base_unit_of_measure: string;
    material_container_type_id: number;
}

export interface MaterialResourceRelations {
    material_container_type: JsonObject;
    material_type: JsonObject;
}

export interface MaterialResourceComputed {
    material_container_type_name: string;
    material_type_code: string;
    material_type_name: string;
}

export type MaterialResource = JsonApiResource<
    MaterialResourceAttributes,
    MaterialResourceRelations,
    MaterialResourceComputed
>;
