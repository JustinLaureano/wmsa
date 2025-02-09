import React, { useMemo, useState } from 'react';
import { alpha, createTheme, getContrastRatio, ThemeProvider } from '@mui/material/styles';
import { grey } from '@mui/material/colors';
import { darkMode, lightMode } from '@/Theme/colors';
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

declare module '@mui/material/styles' {
    interface Palette {
        gray: Palette['primary'];
    }
  
    interface PaletteOptions {
        gray?: PaletteOptions['primary'];
    }
}

declare module '@mui/material/Button' {
    interface ButtonPropsColorOverrides {
        gray: true;
    }
}

declare module '@mui/material/IconButton' {
    interface IconButtonPropsColorOverrides {
        gray: true;
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
                    main: '#01579b',
                  },
                  secondary: {
                    main: '#26c6da',
                  },

                background: {
                    default: mode === 'dark' ? darkMode.background : lightMode.background,
                    paper: mode === 'dark' ? darkMode.backgroundPaper : baseTheme.palette.background.paper,
                },

                text: {
                    primary: mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary,
                    secondary: mode === 'dark' ? darkMode.textSecondary : lightMode.textSecondary
                }
            },

            layouts: {
                dashboard: {
                    bottomAppBarHeight: dimensions.bottomAppBarHeight,
                    bottomNavigationHeight: dimensions.bottomNavigationHeight,
                    drawerWidth: dimensions.drawerWidth,
                    drawerRailWidth: dimensions.drawerRailWidth,
                    conversationDrawerWidth: dimensions.conversationDrawerWidth,
                    notificationsDrawerWidth: dimensions.notificationsDrawerWidth,
                    settingsDrawerWidth: dimensions.settingsDrawerWidth,
                    topAppBarHeight: dimensions.topAppBarHeight
                }
            },

            typography: {
                fontFamily: 'Roboto',
                fontSize: 12,
                h1: {
                    fontSize: '2.25rem',
                    fontWeight: 800,
                    lineHeight: 1,
                },
                h2: {
                    fontSize: '1.875rem',
                    fontWeight: 600,
                    lineHeight: '2.25rem',
                },
                h3: {
                    fontSize: '1.5rem',
                    fontWeight: 500,
                    lineHeight: '2rem',
                },
                h4: {
                    fontSize: '1.25rem',
                    fontWeight: 600,
                    lineHeight: 1.75,
                },
                h5: {
                    fontSize: '1.125rem',
                    fontWeight: 300,
                    lineHeight: 1.5,
                },
                h6: {
                    fontSize: '1rem',
                    fontWeight: 500,
                    lineHeight: 1.25,
                },
                subtitle1: {
                    fontSize: '1rem',
                },
                subtitle2: {
                  fontSize: '.875rem',
                },
                body1: {
                    fontSize: '1rem',
                },
                body2: {
                    fontSize: '.875rem',
                    // color: baseTheme.palette.text.secondary,
                    // ...(mode == 'dark' && {
                    //     color: darkMode.textPrimary
                    // })
                },
                button: {
                    fontSize: '.875rem',
                },
                caption: {
                    fontSize: '.875rem',
                },
                overline: {
                    fontSize: '.875rem',
                },
            },


            shape: {
                borderRadius: 8,
            },
            spacing: 6,


            components: {
                MuiAppBar: {
                  styleOverrides: {
                    root: {
                        backgroundImage: 'none',
                        backgroundColor: mode === 'dark' ? darkMode.background : lightMode.background,
                    },
                  },
                },

                MuiListItemIcon: {
                    styleOverrides: {
                        root: {
                            // color: baseTheme.palette.text.primary,
                            color: mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary,
                        }
                    }
                }
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
