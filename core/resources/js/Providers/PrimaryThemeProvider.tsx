import React, { useMemo, useState } from 'react';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { grey } from '@mui/material/colors';
import { blue } from '@/Theme/colors';
import dimensions from '@/Theme/dimensions';
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

                primary: {
                    main: blue[700]
                },

                background: {
                    default: '#10131c',
                    paper: '#10131c'
                },
                ...(mode == 'light' && {
                    background: {
                        default: '#f0f2f5',
                    }
                }),
            },

            components: {

                // TODO: make apply only to filled button
                // MuiButton: {
                //     styleOverrides: {
                //         root: {
                //             '&:hover': {
                //                 backgroundColor: blue[600],
                //             },
                //         }
                //     }
                // },

                MuiCard: {
                    styleOverrides: {
                        root: {
                            borderRadius: 12,
                            borderColor: 'rgba(0, 0, 0, 0.125)'
                        }
                    }
                },

                MuiPaper: {
                    styleOverrides: {
                        root: {
                            boxShadow: 'rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px'
                        }
                    }
                },

                ...(mode == 'light' && {
                    MuiAppBar: {
                        styleOverrides: {
                            colorPrimary: {
                                backgroundColor: baseTheme.palette.common.white,
                                color: grey[900],
                            },
                        }
                    }
                }),
            },


            layouts: {
                dashboard: {
                    bottomAppBarHeight: dimensions.bottomAppBarHeight,
                    bottomNavigationHeight: dimensions.bottomNavigationHeight,
                    drawerWidth: dimensions.drawerWidth,
                    drawerRailWidth: dimensions.drawerRailWidth,
                    topAppBarHeight: dimensions.topAppBarHeight
                }
            },

            typography: {

                button: {
                    color: 'rgb(52, 71, 103)',
                    fontSize: '0.875rem',
                    letterSpacing: '0.02857rem',
                    lineHeight: 1.5,
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                body1: {
                    color: 'rgb(52, 71, 103)',
                    fontSize: '1rem',
                    fontWeight: 400,
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: baseTheme.palette.common.white
                    })
                },

                body2: {
                    color: 'rgb(123, 128, 154)',
                    fontSize: '0.875rem',
                    letterSpacing: '0.02857rem',
                    lineHeight: 1.5,
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                h1: {
                    fontSize: '2.25rem',
                    fontWeight: 700,
                    color: 'rgb(52, 71, 103)',
                    lineHeight: 1.3,
                    letterSpacing: '0em',
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                h2: {
                    fontSize: '1.875rem',
                    fontWeight: 700,
                    color: 'rgb(52, 71, 103)',
                    lineHeight: 1.375,
                    letterSpacing: '0em',
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                h3: {
                    fontSize: '1.375rem',
                    fontWeight: 600,
                    color: 'rgb(52, 71, 103)',
                    lineHeight: 1.375,
                    letterSpacing: '0.00735em',
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                h4: {
                    fontSize: '1.25rem',
                    fontWeight: 400,
                    color: 'rgb(52, 71, 103)',
                    lineHeight: 1.375,
                    letterSpacing: '0em',
                    margin: 0,
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                h5: {
                    fontSize: '1rem',
                    fontWeight: 500,
                    color: 'rgb(52, 71, 103)',
                    lineHeight: 1.625,
                    letterSpacing: '0.0075em',
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
                    })
                },

                h6: {
                    fontSize: '0.875rem',
                    fontWeight: 500,
                    color: 'rgb(52, 71, 103)',
                    ...(mode == 'dark' && {
                        color: 'rgba(255, 255, 255, 0.8)'
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
