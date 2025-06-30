import { createContext } from "react";
import { AuthContextType } from "@/types";

const AuthContext = createContext<AuthContextType>({
    user: null,
    setUser: () => {},
    building: null,
    setBuilding: () => {},
    permissions: [],
    setPermissions: () => {},
    roles: [],
    setRoles: () => {},
    can: (permission: string) => false,
    is: (role: string) => false,
});

export default AuthContext;
