import { ReactNode } from "react";
import { JsonObject, UserProfileResource } from "@/types";

export interface AuthProviderProps {
    children: ReactNode;
    initialPage?: InitialPageProps;
}

export interface InitialPageProps {
    props: {
        auth?: {
            auth_method: string;
            user: UserProfileResource | null;
        },
        errors?: JsonObject;
        lang: JsonObject;
        recentRequests?: JsonObject;
        ziggy: JsonObject;
    }
}
