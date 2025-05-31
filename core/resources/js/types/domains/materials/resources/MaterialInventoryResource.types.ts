import { MaterialContainerInventoryResource } from "./MaterialContainerInventoryResource.types";
import { JsonApiResource } from "@/types/shared";

export interface MaterialInventoryResourceAttributes {
    material_number: string;
    part_number: string;
    description: string;
    base_unit_of_measure: string;
    base_quantity: number;
}

export interface MaterialInventoryResourceRelations {
    containers: MaterialContainerInventoryResource[];
}

export interface MaterialInventoryResourceComputed {
    material_uuid: string;
    total_quantity: number;
    total_quantity_formatted: string;
    container_count: number;
    title: string;
}

export type MaterialInventoryResource = JsonApiResource<
    MaterialInventoryResourceAttributes,
    MaterialInventoryResourceRelations,
    MaterialInventoryResourceComputed
>;
