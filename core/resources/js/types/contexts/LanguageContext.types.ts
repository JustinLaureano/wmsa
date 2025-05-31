export interface Lang {
    [key: string]: any;
}

export type LanguageContextType = {
    lang: Lang;
    setLang: (lang: Lang) => void;
}