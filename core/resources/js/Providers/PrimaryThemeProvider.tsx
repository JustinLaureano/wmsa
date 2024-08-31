import React, { useMemo, useState } from 'react';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { grey } from '@mui/material/colors';
import ColorModeContext from '@/Contexts/ColorModeContext';
import { PaletteMode } from '@mui/material';

declare module '@mui/material' {
    interface Theme {
        layouts?: any;
    }

    interface ThemeOptions {
        layouts?: any;
    }
}

interface PrimaryThemeProps {
    children: React.ReactNode;
}

export default function PrimaryThemeProvider({ children }: PrimaryThemeProps) {
    const [mode, setMode] = useState<PaletteMode>('light');
    const colorMode = useMemo(
        () => ({
            toggleColorMode: () => {
                setMode((prevMode) => (prevMode === 'light' ? 'dark' : 'light'));
            },
        }),
        [],
    );

    const baseTheme = createTheme();

    const theme = useMemo(
        () => createTheme({
            palette: {
                mode,
                background: {
                    default: '#10131c',
                    paper: '#10131c'
                },
                ...(mode == 'light' && {
                    background: {
                        default: grey[50],
                        paper: grey[50]
                    }
                }),
            },

            ...(mode == 'light' && {
                components: {
                    MuiAppBar: {
                        styleOverrides: {
                            colorPrimary: {
                                backgroundColor: baseTheme.palette.common.white,
                                color: grey[900],
                            },
                        }
                    }
                },
            }),

            layouts: {
                dashboard: {
                    bottomAppBarHeight: '26px',
                    bottomNavigationHeight: '48px',
                    drawerWidth: '180px',
                    drawerRailWidth: '60px',
                    topAppBarHeight: '48px'
                }
            },

            typography: {
                h6: {
                    fontSize: '1.125rem',
                    fontWeight: 500,
                    color: grey[800],
                    ...(mode == 'dark' && {
                        color: baseTheme.palette.common.white
                    })
                },
              },
        }),
        [mode],
    );

    return (
        <ColorModeContext.Provider value={colorMode}>
            <ThemeProvider theme={theme}>
                {children}
            </ThemeProvider>
        </ColorModeContext.Provider>
    );
}
