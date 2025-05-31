import { createContext } from "react";
import { AuthContextType } from "@/types";

const AuthContext = createContext<AuthContextType>({
    user: null,
    setUser: () => {},
});

export default AuthContext;
