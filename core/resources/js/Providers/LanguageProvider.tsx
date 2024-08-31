import React from 'react';
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

    return (
        <LanguageContext.Provider value={initialPage.props?.lang || {}}>
            {children}
        </LanguageContext.Provider>
    );
}
