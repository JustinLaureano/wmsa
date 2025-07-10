import { isAxiosError } from 'axios';
import {
    JsonObject,
    JsonPaginateCollection,
    ViewSortLocationInventoryResource,
} from '@/types';
import ApiService from '../ApiService';

export class SortInventoryService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    /**
     * Fetches paginated sort inventory data
     * @param filterParams - Query parameters for filtering (e.g., page, search)
     * @returns Paginated collection of sort list inventory resources or null on error
     */
    public async getSortInventory(
        filterParams: JsonObject
    ): Promise<JsonPaginateCollection<ViewSortLocationInventoryResource> | null> {
        try {
            const response = await this.apiService.get<JsonPaginateCollection<ViewSortLocationInventoryResource>>(
                route('quality.sort.inventory'),
                { params: filterParams }
            );
            return response.data;
        }
        catch (error) {
            if (isAxiosError(error)) {
                console.error('API error:', error.response?.data || error.message);
            }
            else {
                console.error('Unexpected error:', error);
            }
            // TODO: Log error
            return null;
        }
    }
}
