export interface MaterialRequestData {
    machine_uuid: string;
    part_number: string;
    quantity: number;
}

export interface MaterialRequestResource {
    uuid: string;
    machine_uuid: string;
    part_number: string;
    quantity: number;
    created_at: string;
    // Add other fields as needed
} 