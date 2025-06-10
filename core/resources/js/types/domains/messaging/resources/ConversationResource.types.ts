import { JsonApiResource, MessageResource } from "@/types";

export interface ConversationAttributes {
    uuid: string;
    group_conversation: boolean;
}

export interface ConversationRelations {
    latest_message?: MessageResource;
    participants:{
        data: {
            user_uuid: string;
            name: string;
        }[];
        computed: {
            count: number;
        };
        meta: {
            timestamp: string;
        };
    };
}

export interface ConversationComputed {
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
