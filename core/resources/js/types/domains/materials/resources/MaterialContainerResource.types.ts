import {
    JsonApiResource,
    JsonObject,
    MaterialBarcodeResource
} from "@/types";

export interface MaterialContainerResourceAttributes {
    uuid: string;
    material_uuid: string;
    material_container_type_id: number|null;
    material_tote_type_uuid: string|null;
    movement_status_code: string;
    barcode: string;
    lot_number: string|null;
    quantity: number;
    expiration_date: string;
}

export interface MaterialContainerResourceRelations {
    material?: JsonObject;
    container_type?: JsonObject;
    tote_type?: JsonObject;
    movement_status?: JsonObject;
}

export interface MaterialContainerResourceComputed {
    // barcode_label: BarcodeInformationResource;
    barcode_label: MaterialBarcodeResource;
    container_type_name?: string;
    container_tote_type_name?: string;
    movement_status?: string;
    part_number?: string;
}

export type MaterialContainerResource = JsonApiResource<
    MaterialContainerResourceAttributes,
    MaterialContainerResourceRelations,
    MaterialContainerResourceComputed
>;
