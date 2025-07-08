import { JsonApiResource, JsonObject } from "@/types";

export interface MaterialResourceAttributes {
    uuid: string;
    material_number: string;
    part_number: string;
    description: string;
    material_type_code: string;
    base_quantity: number;
    base_container_unit_quantity: number;
    base_unit_of_measure: string;
    expiration_days: number;
    required_degas_hours: number;
    required_hold_hours: number;
    requires_completion: boolean;
    material_container_type_id: number;
    service_part: boolean;
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
