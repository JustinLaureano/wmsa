import { UserProfileResource } from "../domains/auth/resources/UserProfileResource.types";

export type AuthContextType = {
    user: UserProfileResource | null;
    setUser: (user: UserProfileResource | null) => void;
    buildingId: number | null;
    setBuildingId: (buildingId: number | null) => void;
    permissions: string[];
    setPermissions: (permissions: string[]) => void;
    roles: string[];
    setRoles: (roles: string[]) => void;
    can: (permission: string) => boolean;
    is: (role: string) => boolean;
}