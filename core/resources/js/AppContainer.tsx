import React from 'react';
import { ToastContainer } from 'react-toastify';
import CssBaseline from '@mui/material/CssBaseline';
import AuthProvider from './Providers/AuthProvider';
import LanguageProvider from './Providers/LanguageProvider';
import PrimaryThemeProvider from './Providers/PrimaryThemeProvider';
import UIProvider from './Providers/UIProvider';

interface AppContainerProps {
    children: React.ReactNode;
}

export default function AppContainer({ children, ...props }: AppContainerProps) {
    console.log(props)
    return (
        <LanguageProvider {...props}>
            <PrimaryThemeProvider>
                <AuthProvider {...props}>
                    <UIProvider>
                        <CssBaseline />
                        {children}
                        <ToastContainer autoClose={4000} />
                    </UIProvider>
                </AuthProvider>
            </PrimaryThemeProvider>
        </LanguageProvider>
    );
}
