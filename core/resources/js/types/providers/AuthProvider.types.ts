import { ReactNode } from "react";
import { BuildingResource, JsonObject, UserProfileResource } from "@/types";

export interface AuthProviderProps {
    children: ReactNode;
    initialPage?: InitialPageProps;
}

export interface InitialPageProps {
    props: {
        auth?: {
            auth_method: string;
            building: BuildingResource | null;
            user: UserProfileResource | null;
            permissions: string[];
            roles: string[];
        },
        errors?: JsonObject;
        lang: JsonObject;
        recentRequests?: JsonObject;
        ziggy: JsonObject;
    }
}
