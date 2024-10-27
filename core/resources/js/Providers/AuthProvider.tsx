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
    const [teammate, setTeammate] = useState(initialPage.props?.auth?.teammate || null);

    const defaultValue = {
        teammate,
        setTeammate,
        user,
        setUser
    };

    const dependencies = [user, teammate];

    const value = useMemo(() => defaultValue, dependencies)

    useEffect(() => {
        if (
            user &&
            user.teammate &&
            (!teammate || teammate.clock_number != user.teammate.clock_number)
        ) {
            setTeammate(user.teammate);
        }
    }, [user])

    useEffect(() => {
        if (
            teammate &&
            teammate.user &&
            (!user || user.guid != teammate.user.guid)
        ) {
            setUser(teammate.user);
        }
    }, [teammate])

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
}
