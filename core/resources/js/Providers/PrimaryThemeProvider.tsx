import { useMemo, useState } from 'react';
import { alpha, createTheme, getContrastRatio, ThemeProvider } from '@mui/material/styles';
import { PaletteMode } from '@mui/material';
import { darkMode, lightMode } from '@/Theme/colors';
import dimensions from '@/Theme/dimensions';
import ColorModeContext from '@/Contexts/ColorModeContext';
import { PrimaryThemeProps } from '@/types';
import { red } from '@mui/material/colors';

export default function PrimaryThemeProvider({ children }: PrimaryThemeProps) {
    const [mode, setMode] = useState<PaletteMode>('light');
    const colorMode = useMemo(
        () => ({
            toggleColorMode: () => {
                setMode((prevMode : PaletteMode) => (prevMode === 'light' ? 'dark' : 'light'));
            },
        }),
        [],
    );

    const baseTheme = createTheme();

    const shadows = baseTheme.shadows;
    shadows[1] = '0px 1px 3px rgba(155 155 155 / 40%)';

    const theme = useMemo(
        () => createTheme({
            palette: {
                mode,

                primary: {
                    main: '#01579b',
                },

                secondary: {
                    main: '#26c6da',
                    contrastText: '#fff',
                },

                primaryText: {
                    main: mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary,
                    light: alpha(mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary, 0.5),
                    dark: alpha(mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary, 0.9),
                    contrastText: getContrastRatio(mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary, '#fff') > 4.5 ? '#fff' : '#111',
                },

                secondaryText: {
                    main: mode === 'dark' ? darkMode.textSecondary : lightMode.textSecondary,
                    light: alpha(mode === 'dark' ? darkMode.textSecondary : lightMode.textSecondary, 0.5),
                    dark: alpha(mode === 'dark' ? darkMode.textSecondary : lightMode.textSecondary, 0.9),
                    contrastText: mode === 'dark' ? '#111' : '#fff',
                },

                error: {
                    main: '#f5222d',
                    light: '#ff7875',
                    dark: '#a8071a',
                    contrastText: '#fff',
                },

                success: {
                    main: '#52c41a',
                    light: '#95de64',
                    dark: '#237804',
                    contrastText: '#fff',
                },

                warning: {
                    main: '#faad14',
                    light: '#ffd666',
                    dark: '#ad6800',
                    contrastText: '#fff',
                },

                info: {
                    main: '#13c2c2',
                    contrastText: '#fff',
                },

                danger: {
                    main: red[600],
                    light: red[400],
                    dark: red[700],
                    contrastText: '#fff',
                },

                background: {
                    default: mode === 'dark' ? darkMode.background : lightMode.background,
                    paper: mode === 'dark' ? darkMode.backgroundPaper : lightMode.backgroundPaper,
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
                    fontWeight: 400,
                },
                caption: {
                    fontSize: '.875rem',
                },
                overline: {
                    fontSize: '.875rem',
                },
            },

            shadows,

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
                        color: mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary,
                    },
                  },
                },

                MuiButton: {
                    styleOverrides: {
                        root: {
                            borderRadius: 16,
                            '&:hover': {
                                backgroundColor: 'unset'
                            },
                        }
                    }
                },

                MuiIconButton: {
                    defaultProps: {
                        color: 'primaryText',
                    },
                },

                MuiListItem: {
                    styleOverrides: {
                        root: {
                            ...(mode == 'dark' && {
                                fontWeight: 500,
                                '& .Mui-selected': {
                                    backgroundColor: 'rgba(255, 255, 255, 0.07) !important',
                                },
                            })
                        },
                    }
                },

                MuiListItemIcon: {
                    styleOverrides: {
                        root: {
                            // color: baseTheme.palette.text.primary,
                            color: mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary,
                        }
                    }
                },

                MuiTab: {
                    styleOverrides: {
                        root: {
                            fontSize: '.875rem',
                            textTransform: 'none',
                            color: mode === 'dark' ? darkMode.textPrimary : lightMode.textPrimary,
                            letterSpacing: '0.022em',
                            '&.Mui-selected': {
                                fontWeight: 500,
                            }
                        }
                    }
                },

                MuiTextField: {
                    styleOverrides: {
                        root: {
                            '& .MuiOutlinedInput-input': {
                                '&:focus': {
                                    boxShadow: 'none',
                                    borderColor: 'transparent',
                                    outline: 'none',
                                },
                            },
                        }
                    },
                    defaultProps: {
                        size: 'small',
                    },
                },

                MuiTable: {
                    defaultProps: {
                        size: 'small',
                    },
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
