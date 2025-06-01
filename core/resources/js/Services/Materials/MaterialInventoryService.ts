import { isAxiosError } from 'axios';
import {
    JsonObject,
    JsonPaginateCollection,
    MaterialInventoryResource,
} from '@/types';
import ApiService from '../ApiService';

export class MaterialInventoryService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    /**
     * Fetches paginated material inventory data
     * @param filterParams - Query parameters for filtering (e.g., page, search)
     * @returns Paginated collection of material inventory resources or null on error
     */
    public async getMaterialInventory(
        filterParams: JsonObject
    ): Promise<JsonPaginateCollection<MaterialInventoryResource> | null> {
        try {
            const response = await this.apiService.get<JsonPaginateCollection<MaterialInventoryResource>>(
                route('materials.inventory'),
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
