import { JsonApiResource, MaterialResource, JsonObject } from "@/types";

export interface SortListResourceAttributes {
    id: number;
    uuid: string;
    sort_list_customer_uuid: string;
    material_uuid: string;
    type: string;
    status: string;
    reason: string;
    percent: number;
    standard_time: string;
    cert: string;
    line_side_sort: number;
    list_date: string;
    close_date: string;
}

export interface SortListResourceRelations {
    customer: JsonObject;
    material: MaterialResource;
}

export interface SortListResourceComputed {
    customer_name: string;
    material_part_number: string;
    material_description: string;
}

export type SortListResource = JsonApiResource<
    SortListResourceAttributes,
    SortListResourceRelations,
    SortListResourceComputed
>;
