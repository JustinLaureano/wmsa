import { JsonApiResource, User } from "@/types";

export interface MessageAttributes {
    uuid: string;
    conversation_uuid: string;
    user_uuid: string;
    content: string;
}

export interface MessageRelations {
    status?: {
        is_read: boolean;
        read_at?: string;
    };
    sender: User;
}

export interface MessageComputed {
    sender_uuid: string;
    sender_name: string;
    sent_at_date: string;
    filtered_content: string;
    user_has_read: boolean;
}

export type MessageResource = JsonApiResource<
    MessageAttributes,
    MessageRelations,
    MessageComputed
>;