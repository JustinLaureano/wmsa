import { StorageLocationInformationResource } from "@/types";
import ApiService from '../ApiService';

export class LocationLabelService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async getLocationByBarcode(barcode: string): Promise<StorageLocationInformationResource | null> {
        try {
            const response = await this.apiService.get(route('api.location.information', { barcode: btoa(barcode) }));

            return response.data as StorageLocationInformationResource;
        }
        catch (error) {
            console.error("Failed to fetch barcode information:", error);
            return null;
        }
    }

}