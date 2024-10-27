import { User } from "./auth";

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export interface JsonObject {
    [key: string]: any;
}
