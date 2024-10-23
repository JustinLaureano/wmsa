import { AxiosResponse } from 'axios';
import ApiService from './ApiService';

class MessagingService {
    public async getConversations() {
        try {
            const response = await new ApiService().get<AxiosResponse>(route('api.materials'));
            return response.data.data;
        }
        catch (error) {
            // TODO: log or something failure
            return [];
        }
    }
}

export default MessagingService;