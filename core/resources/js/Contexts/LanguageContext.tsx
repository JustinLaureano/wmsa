import { createContext } from "react";

interface Lang {
    [key: string]: any;
}

type LanguageContextType = {
    lang: Lang;
    setLang: (lang: Lang) => void;
}

const LanguageContext = createContext<LanguageContextType>({
    lang: {},
    setLang: () => {},
});

export default LanguageContext;