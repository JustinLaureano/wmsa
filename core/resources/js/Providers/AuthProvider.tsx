import { useContext, useMemo, useState } from 'react';
import { AuthProviderProps, InitialPageProps } from '@/types';
import AuthContext from '@/Contexts/AuthContext';

const defaultInitialPage: InitialPageProps = {
    props: {
        auth: {
            auth_method: '',
            building: null,
            user: null,
            permissions: [],
            roles: [],
        },
        errors: {},
        lang: {},
        recentRequests: {},
        ziggy: {}
    }
}

export default function AuthProvider({
    children,
    initialPage = defaultInitialPage,
    ...props
}: AuthProviderProps) {
    console.log(initialPage.props.auth);
    const [user, setUser] = useState(initialPage.props?.auth?.user || null);
    const [building, setBuilding] = useState(initialPage.props?.auth?.building || null);
    const [permissions, setPermissions] = useState(initialPage.props?.auth?.permissions || []);
    const [roles, setRoles] = useState(initialPage.props?.auth?.roles || []);

    const can = (permission: string) => {
        return permissions.includes(permission);
    };

    const is = (role: string) => {
        return roles.includes(role);
    };

    const defaultValue = {
        user,
        setUser,
        building,
        setBuilding,
        permissions,
        setPermissions,
        roles,
        setRoles,
        can,
        is
    };

    const dependencies = [
        user,
        building,
        permissions,
        roles
    ];

    const value = useMemo(() => defaultValue, dependencies)

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
}

export const useAuth = () => useContext(AuthContext);
