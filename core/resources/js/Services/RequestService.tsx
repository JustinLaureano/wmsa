import { AxiosResponse } from 'axios';
import ApiService from './ApiService';
import { MaterialRequestData, MaterialRequestResource } from '@/types/requests';

class RequestService {
    public async createMaterialRequest(
        data: MaterialRequestData
    ): Promise<MaterialRequestResource | null> {
        try {
            const response: AxiosResponse = await new ApiService()
                .post(route('api.production.material-request'), data);

            return response.data.data as MaterialRequestResource;
        }
        catch (error) {
            console.log(error)
            return null;
        }
    }
}

export default RequestService; 