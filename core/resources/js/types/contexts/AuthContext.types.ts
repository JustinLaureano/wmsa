import { BuildingResource, UserProfileResource } from "@/types";

export type AuthContextType = {
    user: UserProfileResource | null;
    setUser: (user: UserProfileResource | null) => void;
    building: BuildingResource | null;
    setBuilding: (building: BuildingResource | null) => void;
    permissions: string[];
    setPermissions: (permissions: string[]) => void;
    roles: string[];
    setRoles: (roles: string[]) => void;
    can: (permission: string) => boolean;
    is: (role: string) => boolean;
}