import axios, { AxiosResponse } from 'axios';
import {
    JsonObject,
    JsonPaginateCollection,
    MaterialInventoryResource,
} from '@/types';

class MaterialService {
    public async getMaterialInventory(
        filterParams: JsonObject
    ): Promise<JsonPaginateCollection<MaterialInventoryResource> | null> {
        try {
            const response: AxiosResponse<JsonPaginateCollection<MaterialInventoryResource>> =
                await axios.get(route('materials.inventory'), { params: filterParams });

            return response.data;
        } catch (error) {
            console.error('Failed to fetch material inventory:', error);
            // TODO: Implement proper error handling (e.g., logging to a service)
            return null;
        }
    }
}

export default MaterialService;