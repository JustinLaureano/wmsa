import ApiService from "../ApiService";
import { ConversationFormData, ConversationResource } from "@/types";

export class ConversationCreationService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async createConversation(data: ConversationFormData): Promise<ConversationResource | null> {
        try {
            const response = await this.apiService.post(
                route('api.conversation'),
                data
            );
            return response.data as ConversationResource;
        }
        catch (error) {
            console.error("Failed to create conversation:", error);
            return null;
        }
    }
}