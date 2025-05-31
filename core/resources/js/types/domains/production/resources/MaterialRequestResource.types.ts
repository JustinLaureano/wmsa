import { JsonApiResource } from '@/types/shared';

// Define specific types for attributes, relations, and computed fields
export interface MaterialRequestAttributes {
    uuid: string;
    material_request_status_code: string;
    material_request_type_code: string;
    requester_user_uuid: string;
    requested_at: string;
}

export interface MaterialRequestRelations {
    status: {
        code: string;
        name: string;
        description: string;
    }
    requester: {
        uuid: string;
        organization_uuid: string;
        domain_account_guid: string;
        teammate_clock_number: number;
    }
    items: {
        uuid: string;
        material_request_uuid: string;
        material_uuid: string;
        quantity_requested: number;
        quantity_delivered: number;
        unit_of_measure: string;
        machine_uuid: string;
        storage_location_uuid: string;
        request_item_status_code: string;
        created_at: string;
        updated_at?: string;
        deleted_at?: string;
    }[];
}

export interface MaterialRequestComputed {
    title: string;
    requester_name: string;
    requested_at: string;
    status: string;
}

// Extend JsonApiResource
export type MaterialRequestResource = JsonApiResource<
    MaterialRequestAttributes,
    MaterialRequestRelations,
    MaterialRequestComputed
>;