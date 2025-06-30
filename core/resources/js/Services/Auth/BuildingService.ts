import { isAxiosError } from 'axios';
import {
    BuildingResource,
} from '@/types';
import ApiService from '../ApiService';

export class BuildingService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    /**
     * Sets the session building
     * @param building_id - The ID of the building to set
     * @returns Building resource or null on error
     */
    public async setSessionBuilding(
        building_id: number
    ): Promise<BuildingResource | null> {
        try {
            const response = await this.apiService.post<BuildingResource>(
                route('api.auth.building'),
                { building_id }
            );

            return response.data as BuildingResource;
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
