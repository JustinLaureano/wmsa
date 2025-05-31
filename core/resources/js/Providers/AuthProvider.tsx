import { useMemo, useState } from 'react';
import { AuthProviderProps } from '@/types';
import AuthContext from '@/Contexts/AuthContext';

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
