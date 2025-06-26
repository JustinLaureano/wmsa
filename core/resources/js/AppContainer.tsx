import { ReactNode } from 'react';
import { ToastContainer } from 'react-toastify';
import CssBaseline from '@mui/material/CssBaseline';
import { AuthProvider } from './Providers/AuthProvider';
import LanguageProvider from './Providers/LanguageProvider';
import PrimaryThemeProvider from './Providers/PrimaryThemeProvider';
import UIProvider from './Providers/UIProvider';
import MessagingProvider from './Providers/MessagingProvider';

export default function AppContainer({ children, ...props }: { children: ReactNode }) {

    return (
        <LanguageProvider {...props}>
            <PrimaryThemeProvider>
                <AuthProvider {...props}>
                    <MessagingProvider {...props}>
                        <UIProvider>
                            <CssBaseline />
                            {children}
                            <ToastContainer autoClose={4000} />
                        </UIProvider>
                    </MessagingProvider>
                </AuthProvider>
            </PrimaryThemeProvider>
        </LanguageProvider>
    );
}
