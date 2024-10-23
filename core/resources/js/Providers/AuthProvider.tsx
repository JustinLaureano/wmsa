import React, { useMemo, useState } from 'react';
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
    const [teammate, setTeammate] = useState(initialPage.props?.auth?.teammate || null);

    const defaultValue = {
        teammate,
        setTeammate,
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
