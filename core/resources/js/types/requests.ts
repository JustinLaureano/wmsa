import { JsonObject } from ".";

// moved
export interface MaterialRequestData {
    machine_uuid: string | null;
    storage_location_uuid: string | null;
    part_number: string;
    quantity: number;
    unit_of_measure: string;
    requester_user_uuid: string;
    requested_at: Date;
}

// moved, probably not needed
export interface MaterialRequestResource {
    uuid: string;
    machine_uuid: string;
    part_number: string;
    quantity: number;
    created_at: string;
    // Add other fields as needed
}

// moved
export interface MaterialRequestListCollection {
    data: MaterialRequestListResource[];
    computed: JsonObject;
    meta: JsonObject;
}

// moved
export interface MaterialRequestResource {
    uuid: string;
    attributes: MaterialRequestAttributes;
    computed: MaterialRequestComputed;
    relations: MaterialRequestRelations;
}

// moved
export interface MaterialRequestListResource extends JsonObject {
    uuid: string;
    title: string;
    requester_name: string;
    requested_at: string;
    status: string;
    type: string;
    items: MaterialRequestItemListResource[];
}

// moved
export interface MaterialRequestItemListResource extends JsonObject {
    uuid: string;
    material_part_number: string;
    material_description: string;
    quantity_requested: number;
    quantity_delivered: number;
    unit_of_measure: string;
    machine_name: string | null;
    storage_location_name: string | null;
    status: string;
}

// moved, not needed
interface MaterialRequestAttributes extends JsonObject {}


// moved, not needed
interface MaterialRequestComputed extends JsonObject {
    title: string;
    material_part_number: string;
    material_description: string;
    machine_name: string;
    storage_location_name: string;
    requester_name: string;
    requested_at: string;
    status: string;
    quantity: number;
    unit_of_measure: string;
}

// moved, not needed
interface MaterialRequestRelations extends JsonObject {}
