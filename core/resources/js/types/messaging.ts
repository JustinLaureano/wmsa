import { JsonObject } from ".";

export interface Conversation {
    uuid: string;
    group_conversation: boolean;
    created_at: string
}

export interface MessagesResource {
    uuid: string;
    attributes: JsonObject;
    computed: JsonObject;
    relations: JsonObject;
}

export interface ConversationResource {
    uuid: string;
    attributes: ConversationAttributes;
    computed: ConversationComputed;
    relations: ConversationRelations;
}

interface ConversationAttributes extends JsonObject {}

interface ConversationComputed extends JsonObject {}

interface ConversationRelations extends JsonObject {}