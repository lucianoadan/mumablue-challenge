export interface ApiResponse<T> {
    errors: string[];
    message: string;
    payload: T;
}