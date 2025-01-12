import React, { useEffect, useMemo, useState } from 'react';
import AuthContext from '@/Contexts/AuthContext';

interface AuthProviderProps {
    children: React.ReactNode;
    initialPage?: Record<string, any>;
}

const defaultInitialPage = { props: {} }

export default function AuthProvider({
    children,
    initialPage = defaultInitialPage,
    ...props
}: AuthProviderProps) {
    const [user, setUser] = useState(initialPage.props?.auth?.user || null);

    const defaultValue = {
        user,
        setUser
    };

    const dependencies = [user];

    const value = useMemo(() => defaultValue, dependencies)

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
}
