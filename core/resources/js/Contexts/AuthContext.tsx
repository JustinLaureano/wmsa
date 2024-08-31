import { createContext } from "react";

interface User {
    [key: string]: any;
}

type AuthContextType = {
    user: User | null;
    setUser: (user: User | null) => void;
}

const AuthContext = createContext<AuthContextType>({
    user: null,
    setUser: () => {},
});

export default AuthContext;