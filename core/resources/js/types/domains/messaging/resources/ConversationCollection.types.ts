import { JsonApiCollection } from "@/types/shared";
import { ConversationResource } from "./ConversationResource.types";

export type ConversationCollection = JsonApiCollection<
    ConversationResource,
    {
        unread_messages: number;
    }
>;