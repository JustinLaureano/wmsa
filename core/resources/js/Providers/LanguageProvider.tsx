import React, { useMemo, useState } from 'react';
import LanguageContext from '@/Contexts/LanguageContext';

interface LanguageProviderProps {
    children: React.ReactNode;
    initialPage?: Record<string, any>;
}

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
