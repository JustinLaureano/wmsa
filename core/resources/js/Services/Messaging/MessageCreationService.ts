import { isAxiosError } from 'axios';
import { MessageFormData, MessageResource } from '@/types';
import ApiService from '../ApiService';

export class MessageCreationService {
    private apiService: ApiService;

    constructor(apiService: ApiService = new ApiService()) {
        this.apiService = apiService;
    }

    /**
     * Creates a new message in a conversation
     * @param data - The message form data
     * @returns The created message resource or null on error
     */
    public async createMessage(data: MessageFormData): Promise<MessageResource | null> {
        try {
            const response = await this.apiService.post<{ data: MessageResource }>(
                route('api.messaging.message'),
                data
            );

            return response.data.data;
        }
        catch (error) {
            if (isAxiosError(error)) {
                console.error('Failed to create message:', error.response?.data || error.message);
            }
            else {
                console.error('Unexpected error:', error);
            }
            // TODO: Log error
            return null;
        }
    }
}