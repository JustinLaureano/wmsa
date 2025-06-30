import { createContext } from "react";
import { AuthContextType } from "@/types";

const AuthContext = createContext<AuthContextType>({
    user: null,
    setUser: () => {},
    buildingId: null,
    setBuildingId: () => {},
    permissions: [],
    setPermissions: () => {},
    roles: [],
    setRoles: () => {},
    can: (permission: string) => false,
    is: (role: string) => false,
});

export default AuthContext;
