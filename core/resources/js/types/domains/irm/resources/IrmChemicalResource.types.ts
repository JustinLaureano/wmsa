import { JsonApiResource, MaterialResource, StorageLocationResourceAttributes } from "@/types";

export interface IrmChemicalResourceAttributes {
    id: number;
    uuid: string;
    lot_quantity: number;
    unit_quantity: number;
    assigned_storage_location_uuid: string;
    drop_off_storage_location_uuid: string;
}

export interface IrmChemicalResourceRelations {
    material: MaterialResource;
    assigned_storage_location: StorageLocationResourceAttributes;
    drop_off_storage_location: StorageLocationResourceAttributes;
}

export interface IrmChemicalResourceComputed {
    barcode_label_id: number;
    material_part_number: string;
    material_description: string;
    base_unit_of_measure: string;
    material_container_type_name: string;
    assigned_storage_location_name: string;
    drop_off_storage_location_name: string;
}

export type IrmChemicalResource = JsonApiResource<
    IrmChemicalResourceAttributes,
    IrmChemicalResourceRelations,
    IrmChemicalResourceComputed
>;
