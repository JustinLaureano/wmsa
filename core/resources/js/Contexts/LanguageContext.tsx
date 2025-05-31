import { createContext } from "react";
import { LanguageContextType } from "@/types";

const LanguageContext = createContext<LanguageContextType>({
    lang: {},
    setLang: () => {},
});

export default LanguageContext;