import { JsonApiResource, JsonObject } from "@/types";

export interface SafetyStockReportResourceAttributes {
    uuid: string;
    part_number: string;
    material_type_code: string;
    building_1_safety_stock: number|null;
    building_1_on_hand: number;
    building_1_uom: string;
    building_1_notes: string|null;
    building_2_safety_stock: number|null;
    building_2_on_hand: number;
    building_2_uom: string;
    building_2_notes: string|null;
    building_3_safety_stock: number|null;
    building_3_on_hand: number;
    building_3_uom: string;
    building_3_notes: string|null;
    // Add other buildings if needed
}

export interface SafetyStockReportResourceRelations {
    containers: JsonObject[];
    chemical: JsonObject;
}

export interface SafetyStockReportResourceComputed {
    material_uuid: string;
    part_number: string;
    building_1_safety_stock_formatted: string|null;
    building_1_on_hand_formatted: string|null;
    building_1_difference: number;
    building_1_notes: string|null;
    building_2_safety_stock_formatted: string|null;
    building_2_on_hand_formatted: string|null;
    building_2_difference: number;
    building_2_notes: string|null;
    building_3_safety_stock_formatted: string|null;
    building_3_on_hand_formatted: string|null;
    building_3_difference: number;
    building_3_notes: string|null;
}

export type SafetyStockReportResource = JsonApiResource<
    SafetyStockReportResourceAttributes,
    SafetyStockReportResourceRelations,
    SafetyStockReportResourceComputed
>;
