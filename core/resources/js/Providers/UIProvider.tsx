import React, { useMemo, useState } from 'react';
import UIContext from '@/Contexts/UIContext';

interface UIProviderProps {
    children: React.ReactNode;
}

export default function UIProvider({ children }: UIProviderProps) {
    const [navigationDrawerOpen, setNavigationDrawerOpen] = useState(true);
    const [messagesDialogOpen, setMessagesDialogOpen] = useState(false);
    const [loginDialogOpen, setLoginDialogOpen] = useState(false);

    const defaultValue = {
        navigationDrawerOpen,
        setNavigationDrawerOpen,
        messagesDialogOpen,
        setMessagesDialogOpen,
        loginDialogOpen,
        setLoginDialogOpen,
    }

    const dependencies = [
        loginDialogOpen,
        messagesDialogOpen,
        navigationDrawerOpen
    ];

    const value = useMemo(() => defaultValue, dependencies)

    return (
        <UIContext.Provider value={value}>
            {children}
        </UIContext.Provider>
    );
}
