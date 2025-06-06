import { JsonObject } from "@/types";

export interface MaterialRequestItemListResource {
    uuid: string;
    description: string;
    material_part_number: string;
    material_description: string;
    quantity_requested: number;
    quantity_delivered: number;
    unit_of_measure: string;
    machine_name: string | null;
    storage_location_name: string | null;
    status: string;
    material_tote_type_name: string | null;
    container_allocation: JsonObject | null;
    available_material_containers: JsonObject | null;
    total_available_material_containers: number;
}