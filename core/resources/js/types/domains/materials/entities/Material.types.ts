export interface Material {
    id: number;
    uuid: string;
    material_number?: string;
    part_number: string;
    description: string;
    material_type_code: string|null;
    base_quantity: number;
    base_unit_of_measure: string;
}