export interface MaterialRequestData {
    machine_uuid: string | null;
    storage_location_uuid: string | null;
    part_number: string;
    quantity: number;
    unit_of_measure: string;
    requester_user_uuid: string;
    requested_at: Date;
}

export interface MaterialRequestResource {
    uuid: string;
    machine_uuid: string;
    part_number: string;
    quantity: number;
    created_at: string;
    // Add other fields as needed
} 