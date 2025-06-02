import axios from "axios";
import { MessageResource } from "@/types";

interface MessageFormData {
    conversation_uuid: string;
    user_uuid: string;
    content: string;
}

export class MessageCreationService {
    async createMessage(data: MessageFormData): Promise<MessageResource | null> {
        try {
            const response = await axios.post("/api/messaging/message", data);
            return response.data as MessageResource;
        }
        catch (error) {
            console.error("Failed to create message:", error);
            return null;
        }
    }
}