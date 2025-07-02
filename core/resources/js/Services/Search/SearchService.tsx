import { JsonObject } from '@/types';
import ApiService from '../ApiService';

export class SearchService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async search(query: string): Promise<JsonObject | null> {
        try {
            const response = await this.apiService.get(route('api.search', { query }));

            return response.data as JsonObject;
        }
        catch (error) {
            console.error("Failed to search:", error);
            return null;
        }
    }

}