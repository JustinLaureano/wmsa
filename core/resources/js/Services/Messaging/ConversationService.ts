import axios from "axios";
import { ConversationCollection, MessageResource } from "@/types";

export class ConversationService {
    async getConversations(): Promise<ConversationCollection> {
        try {
            const response = await axios.get("/api/conversations");
            return response.data as ConversationCollection;
        }
        catch (error) {
            console.error("Failed to fetch conversations:", error);
            return { data: [], computed: { unread_messages: 0 }, meta: {} };
        }
    }

    async getConversationMessages(conversationUuid: string): Promise<MessageResource[]> {
        try {
            const response = await axios.get(`/api/conversation/${conversationUuid}/messages`);
            return response.data.data as MessageResource[];
        }
        catch (error) {
            console.error("Failed to fetch conversation messages:", error);
            return [];
        }
    }
}