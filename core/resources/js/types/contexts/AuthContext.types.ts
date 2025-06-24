import { UserProfileResource } from "../domains/auth/resources/UserProfileResource.types";

export type AuthContextType = {
    user: UserProfileResource | null;
    setUser: (user: UserProfileResource | null) => void;
}