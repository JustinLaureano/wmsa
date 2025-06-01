import axios, { AxiosRequestConfig, AxiosResponse } from 'axios';

class ApiService {
    /**
     * Performs a GET request to the specified endpoint
     * @param endpoint - The API endpoint URL
     * @param config - Optional Axios request configuration (e.g., params, headers)
     * @returns The Axios response with the specified type
     * @throws AxiosError if the request fails
     */
    public async get<T>(endpoint: string, config?: AxiosRequestConfig): Promise<AxiosResponse<T>> {
        try {
            const response: AxiosResponse<T> = await axios.get(endpoint, config);

            return response;
        }
        catch (error) {
            throw error; // Let the caller handle the error
        }
    }

    /**
     * Performs a POST request to the specified endpoint
     * @param endpoint - The API endpoint URL
     * @param body - The request payload
     * @returns The Axios response with the specified type
     * @throws AxiosError if the request fails
     */
    public async post<T>(endpoint: string, body: unknown): Promise<AxiosResponse<T>> {
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