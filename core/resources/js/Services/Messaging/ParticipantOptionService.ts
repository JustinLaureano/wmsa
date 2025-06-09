import ApiService from "../ApiService";
import { ParticipantAutocompleteResource } from "@/types";

export class ParticipantOptionService {
    private apiService: ApiService;

    constructor() {
        this.apiService = new ApiService();
    }

    async getParticipantOptions(): Promise<ParticipantAutocompleteResource[] | null> {
        try {
            const response = await this.apiService.get(route('api.messaging.participant.options'));

            return response.data as ParticipantAutocompleteResource[];
        }
        catch (error) {
            console.error("Failed to get participant options:", error);
            return null;
        }
    }
}