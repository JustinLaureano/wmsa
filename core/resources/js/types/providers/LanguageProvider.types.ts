import { ReactNode } from "react";

export interface LanguageProviderProps {
    children: ReactNode;
    initialPage?: Record<string, any>;
}
