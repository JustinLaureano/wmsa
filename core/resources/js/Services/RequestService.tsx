import { AxiosResponse } from 'axios';
import ApiService from './ApiService';
import { MaterialRequestData, MaterialRequestResource } from '@/types/requests';

class RequestService {
    public async createMaterialRequest(
        data: MaterialRequestData
    ): Promise<AxiosResponse | null> {
        try {
            const response: AxiosResponse = await new ApiService()
                .post(route('api.production.material-request'), data);

            return response;
        }
        catch (error) {
            console.log(error)
            return null;
        }
    }
}

export default RequestService; 