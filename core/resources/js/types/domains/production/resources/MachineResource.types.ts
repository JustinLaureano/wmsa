import { JsonApiResource, JsonObject, BuildingResource } from "@/types";

export interface MachineResourceAttributes {
    uuid: string;
    name: string;
    barcode: string;
    building_id: string;
    machine_type_id: string;
    restrict_request_allocations: boolean;
    disabled: boolean;
}

export interface MachineResourceRelations {
    building: BuildingResource;
    type: JsonObject;
}

export interface MachineResourceComputed {
    barcode_label: string;
    building_name: string;
    disabled: boolean;
    machine_name: string;
    machine_type_code: string;
    machine_type_name: string;
    restrict_request_allocations: boolean;
}

export type MachineResource = JsonApiResource<
    MachineResourceAttributes,
    MachineResourceRelations,
    MachineResourceComputed
>;
