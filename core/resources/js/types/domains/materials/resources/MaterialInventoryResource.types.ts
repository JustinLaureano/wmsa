import { MaterialContainerInventoryResource } from "./MaterialContainerInventoryResource.types";

export interface MaterialInventoryResource {
    uuid: string;
    attributes: {
        material_number: string;
        part_number: string;
        description: string;
        base_unit_of_measure: string;
        base_quantity: number;
    };
    relations: {
        containers: MaterialContainerInventoryResource[];
    };
    computed: {
        material_uuid: string;  
        total_quantity: number;
        container_count: number;
        title: string;
    };
}