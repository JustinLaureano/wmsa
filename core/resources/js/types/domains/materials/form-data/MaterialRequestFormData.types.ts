export interface MaterialRequestFormData {
    machine_uuid: string | null;
    storage_location_uuid: string | null;
    part_number: string;
    quantity: number;
    unit_of_measure: string;
    requester_user_uuid: string;
    requested_at: Date;
}