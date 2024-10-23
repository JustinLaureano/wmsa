import { createContext } from "react";

interface User {
    [key: string]: any;
}

interface Teammate {
    [key: string]: any;
}

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
