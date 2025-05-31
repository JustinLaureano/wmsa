import { ReactNode } from "react";

export interface AuthProviderProps {
    children: ReactNode;
    initialPage?: Record<string, any>;
}
