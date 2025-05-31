import { useMemo, useState } from 'react';
import { LanguageProviderProps } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';

const defaultInitialPage = { props: {} }

export default function LanguageProvider({
    children,
    initialPage = defaultInitialPage,
    ...props
}: LanguageProviderProps) {

    const [lang, setLang] = useState(initialPage.props?.lang || {});

    const defaultValue = {
        lang,
        setLang
    };

    const dependencies = [lang];

    const value = useMemo(() => defaultValue, dependencies);

    return (
        <LanguageContext.Provider value={value}>
            {children}
        </LanguageContext.Provider>
    );
}
