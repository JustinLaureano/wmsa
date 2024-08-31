import React from 'react';
import { Box, Paper, Stack, Typography, useTheme } from '@mui/material';

declare module '@mui/material' {
    interface Theme {
        layouts?: any;
    }
}

export default function BottomAppBar(props : Record<string, any>) {
    const theme = useTheme();

    return (
        <Paper
            elevation={0}
            sx={{
                display: 'none',
                position: 'fixed',
                bottom: 0,
                left: 0,
                right: 0,
                height: theme.layouts.dashboard.bottomAppBarHeight,
                borderTop: 1,
                borderColor: theme.palette.mode == 'light' ? '#0000001f' : '#ffffff2e',
                zIndex: (theme) => theme.zIndex.drawer + 1,
                [theme.breakpoints.up('md')]: {
                    display: 'block'
                }
            }}
        >
            <Stack
                direction="row"
                spacing={1}
            >
                <Box
                    sx={{
                        flexGrow: 1,
                    }}
                >
                </Box>
                <Stack
                    justifyContent="center"
                    alignItems="center"
                    sx={{
                        flexGrow: 1,
                        textAlign: 'center'
                    }}
                >
                    <Typography
                        variant="overline"
                        sx={{
                            fontWeight: 500
                        }}
                    >
                        v0.1.1
                    </Typography>
                </Stack>
                <Box
                    sx={{
                        flexGrow: 1,
                    }}
                >
                </Box>
            </Stack>
        </Paper>
    );
}
