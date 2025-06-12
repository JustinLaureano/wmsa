import { isAxiosError } from 'axios';
import {
    JsonObject,
    JsonPaginateCollection,
    StorageLocationResource,
} from '@/types';
import ApiService from '../ApiService';

export class StorageLocationService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    /**
     * Fetches paginated storage location data
     * @param filterParams - Query parameters for filtering (e.g., page, search)
     * @returns Paginated collection of storage location resources or null on error
     */
    public async getStorageLocations(
        filterParams: JsonObject
    ): Promise<JsonPaginateCollection<StorageLocationResource> | null> {
        try {
            const response = await this.apiService.get<JsonPaginateCollection<StorageLocationResource>>(
                route('locations.show'),
                { params: filterParams }
            );

            return response.data as JsonPaginateCollection<StorageLocationResource>;
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
