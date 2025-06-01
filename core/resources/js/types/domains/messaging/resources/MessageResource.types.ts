import { JsonApiResource} from "@/types";

export interface MessageAttributes {
    uuid: string;
    conversation_uuid: string;
    sender_id: string;
    sender_type: string;
    content: string;
}

export interface MessageRelations {
    [key: string]: any;
}

export interface MessageComputed {
    [key: string]: any;
}

export type MessageResource = JsonApiResource<
    MessageAttributes,
    MessageRelations,
    MessageComputed
>;
