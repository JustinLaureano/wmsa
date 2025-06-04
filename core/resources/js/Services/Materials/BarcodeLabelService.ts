import { BarcodeInformationResource } from "@/types";
import ApiService from '../ApiService';

export class BarcodeLabelService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async getBarcodeLabel(barcode: string): Promise<BarcodeInformationResource | null> {
        try {
            const response = await this.apiService.get(route('api.barcode.information', { barcode: btoa(barcode) }));

            return response.data as BarcodeInformationResource;
        }
        catch (error) {
            console.error("Failed to fetch barcode information:", error);
            return null;
        }
    }

}