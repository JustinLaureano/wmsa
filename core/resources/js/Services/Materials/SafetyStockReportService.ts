import { isAxiosError } from 'axios';
import {
    JsonObject,
    JsonPaginateCollection,
    SafetyStockReportResource,
} from '@/types';
import ApiService from '../ApiService';

export class SafetyStockReportService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    /**
     * Fetches paginated safety stock report data
     * @param filterParams - Query parameters for filtering (e.g., page, search)
     * @returns Paginated collection of safety stock report resources or null on error
     */
    public async getSafetyStockReport(
        filterParams: JsonObject
    ): Promise<JsonPaginateCollection<SafetyStockReportResource> | null> {
        try {
            const response = await this.apiService.get<JsonPaginateCollection<SafetyStockReportResource>>(
                route('materials.safety-stock'),
                { params: filterParams }
            );

            return response.data as JsonPaginateCollection<SafetyStockReportResource>;
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
