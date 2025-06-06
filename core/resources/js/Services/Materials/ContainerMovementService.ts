import ApiService from '../ApiService';

export class ContainerMovementService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async initiateContainerMovement(materialContainerUuid: string, locationUuid: string, userUuid: string): Promise<any | null> {
        try {
            const response = await this.apiService.post(route('api.container.movement'), {
                material_container_uuid: materialContainerUuid,
                storage_location_uuid: locationUuid,
                handler_user_uuid: userUuid,
                moved_at: new Date().toISOString()
            });

            return response.data as any;
        }
        catch (error) {
            console.error("Failed to initiate container movement:", error);
            return null;
        }
    }
}