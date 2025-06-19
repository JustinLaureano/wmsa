import { JsonApiResource, StorageLocationResourceAttributes, IrmChemicalResourceAttributes } from "@/types";

export interface IrmChemicalLocationResourceAttributes {
    uuid: string;
    lot_quantity: number;
    unit_quantity: number;
    assigned_storage_location_uuid: string;
    drop_off_storage_location_uuid: string;
}

export interface IrmChemicalLocationResourceRelations {
    irm_chemical: IrmChemicalResourceAttributes;
    storage_location: StorageLocationResourceAttributes;
}

export interface IrmChemicalLocationResourceComputed {
    irm_chemical_part_number: string;
    irm_chemical_description: string;
    irm_chemical_container_type_name: string;
    irm_chemical_quantity: number;
    storage_location_name: string;
    stored_at: string;
}

export type IrmChemicalLocationResource = JsonApiResource<
    IrmChemicalLocationResourceAttributes,
    IrmChemicalLocationResourceRelations,
    IrmChemicalLocationResourceComputed
>;
