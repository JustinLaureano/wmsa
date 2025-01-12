import { User } from "@/types/auth";
import { createContext } from "react";

type AuthContextType = {
    user: User | null;
    setUser: (user: User | null) => void;
}

const AuthContext = createContext<AuthContextType>({
    user: null,
    setUser: () => {},
});

export default AuthContext;
