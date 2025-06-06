import ApiService from "../ApiService";

export class MessageStatusService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async markMessagesAsRead(conversationUuid: string, userUuid: string): Promise<any | null> {
        try {
            const response = await this.apiService.post(
                route('api.messaging.message.read'),
                {
                    conversation_uuid: conversationUuid,
                    user_uuid: userUuid,
                    read_at: new Date().toISOString(),
                }
            );
            return response.data as any;
        }
        catch (error) {
            console.error("Failed to mark messages as read:", error);
            return null;
        }
    }
}