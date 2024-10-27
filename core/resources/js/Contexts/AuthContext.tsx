import { Teammate, User } from "@/types/auth";
import { createContext } from "react";

type AuthContextType = {
    teammate: Teammate | null;
    setTeammate: (teammate: Teammate | null) => void;

    user: User | null;
    setUser: (user: User | null) => void;
}

const AuthContext = createContext<AuthContextType>({
    teammate: null,
    setTeammate: () => {},

    user: null,
    setUser: () => {},
});

export default AuthContext;
