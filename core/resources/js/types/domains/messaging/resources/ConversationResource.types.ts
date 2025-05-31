import { JsonApiResource} from "@/types";

export interface ConversationAttributes {
    [key: string]: any;
}

export interface ConversationRelations {
    [key: string]: any;
}

export interface ConversationComputed {
    avatar_initials: string;
    title: string;
    subject: string;
    latest_message_date: string;
    unread_messages: number;
}

export type ConversationResource = JsonApiResource<
    ConversationAttributes,
    ConversationRelations,
    ConversationComputed
>;
