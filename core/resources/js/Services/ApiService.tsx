import axios, { AxiosResponse } from 'axios';

interface ApiResponse<T> {
    data: T;
    status: number;
    message: string;
}

class ApiService {
    public async get<T>(endpoint: string): Promise<AxiosResponse<T>> {
        try {
            const response: AxiosResponse<T> = await axios.get(endpoint);

            return response;
        }
        catch (error: any) {
            throw error;
        }
    }

    public async post<T>(endpoint: string, body: any): Promise<AxiosResponse<T>> {
        try {
            const response: AxiosResponse<T> = await axios.post(endpoint, body);

            return response;
        }
        catch (error) {
            throw error;
        }
    }
}

export default ApiService;