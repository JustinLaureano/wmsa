import { User } from "../domains/auth/entities";

export type AuthContextType = {
    user: User | null;
    setUser: (user: User | null) => void;
}