import ApiService from '../ApiService';

export class ContainerQuantityService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async updateContainerQuantity(materialContainerUuid: string, quantity: number, userUuid: string): Promise<any | null> {
        try {
            const response = await this.apiService.post(route('api.container.quantity'), {
                material_container_uuid: materialContainerUuid,
                quantity: quantity,
                user_uuid: userUuid,
                updated_at: new Date().toISOString()
            });

            return response.data as any;
        }
        catch (error) {
            console.error("Failed to update container quantity:", error);
            return null;
        }
    }
}
