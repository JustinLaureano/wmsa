import { AxiosResponse } from 'axios';
import ApiService from './ApiService';

class MessagingService {
    public async getConversations(participant_id: string, participant_type: string) {
        const params = {
            participant_id,
            participant_type
        };

        try {
            const response: AxiosResponse = await new ApiService()
                .get(route('api.conversations', params));
            return response.data;
        }
        catch (error) {
            console.log(error)
            // TODO: log or something failure
            return [];
        }
    }

    public async getConversationMessages(conversation_uuid: string) {
        const params = { conversation_uuid };

        try {
            const response: AxiosResponse = await new ApiService()
                .get(route('api.conversation.messages', params));
            return response.data;
        }
        catch (error) {
            console.log(error)
            // TODO: log or something failure
            return [];
        }
    }
}

export default MessagingService;