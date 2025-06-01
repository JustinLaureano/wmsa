import { isAxiosError } from 'axios';
import { JsonObject, ConversationCollection, MessageResource } from '@/types';
import ApiService from '../ApiService';

export class ConversationService {
    private apiService: ApiService;

    constructor(apiService: ApiService = new ApiService()) {
        this.apiService = apiService;
    }

    /**
     * Fetches conversations for a participant
     * @param participant_id - The participant's ID
     * @param participant_type - The participant's type (user or teammate)
     * @returns The paginated conversation collection
     */
    public async getConversations(
        participant_id: string,
        participant_type: string
    ): Promise<ConversationCollection | null> {
        const params = { participant_id, participant_type };

        try {
            const response = await this.apiService.get<ConversationCollection>(
                route('api.conversations', params)
            );

            return response.data;
        }
        catch (error) {
            if (isAxiosError(error)) {
                console.error('Failed to fetch conversations:', error.response?.data || error.message);
            }
            else {
                console.error('Unexpected error:', error);
            }
            // TODO: Log error
            return null;
        }
    }

    /**
     * Fetches messages for a conversation
     * @param conversation_uuid - The conversation's UUID
     * @returns An array of message resources
     */
    public async getConversationMessages(conversation_uuid: string): Promise<MessageResource[]> {
        const params = { conversation_uuid };

        try {
            const response = await this.apiService.get<{ data: MessageResource[] }>(
                route('api.conversation.messages', params)
            );

            return response.data.data;
        }
        catch (error) {
            if (isAxiosError(error)) {
                console.error('Failed to fetch conversation messages:', error.response?.data || error.message);
            }
            else {
                console.error('Unexpected error:', error);
            }
            // TODO: Log error
            return [];
        }
    }
}