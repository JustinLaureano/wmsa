import { IrmChemicalResourceAttributes, JsonApiResource, MaterialResource, IrmChemicalLocationResource } from "@/types";

export interface IrmChemicalInventoryResourceRelations {
    material: MaterialResource;
    inventory: IrmChemicalLocationResource[];
}

export interface IrmChemicalInvenotryResourceComputed {
    part_number: string;
    total_quantity: number;
    unit_of_measure_label: string;
}

export type IrmChemicalInventoryResource = JsonApiResource<
    IrmChemicalResourceAttributes,
    IrmChemicalInventoryResourceRelations,
    IrmChemicalInvenotryResourceComputed
>;
