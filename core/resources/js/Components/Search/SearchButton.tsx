import React from 'react';
import { JsonObject } from '@/types';
import { Search } from '@mui/icons-material';
import { Button, Box, useTheme, Stack, Typography } from '@mui/material';
import { grey } from '@mui/material/colors';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function SearchButton(props : JsonObject) {
    const { lang } = useLanguage();
    const theme = useTheme();

    const handleButtonClick= (e: React.MouseEvent<HTMLElement>) => {
        console.log('needes implemented')
    }

    return (
        <Button
            variant="outlined"
            color="info"
            startIcon={<Search />}
            onClick={handleButtonClick}
            sx={{
                borderRadius: 4,
                textTransform: 'none',
            }}
        >
            <Typography variant="subtitle2" fontWeight={400}>
                {lang.search}...
            </Typography>

            <Stack sx={{ ml: 6 }}>

                <Box
                    component="span"
                    sx={{
                        background: grey[200],
                        padding: '1px 8px',
                        marginLeft: theme.spacing(2),
                        borderRadius: 2,
                        fontSize: '.675rem',
                        ...(
                            theme.palette.mode == 'dark' && {
                                background: theme.palette.background.default,
                            }
                        )
                    }}
                >
                    Ctrl + K
                </Box>
            </Stack>
        </Button>
    );
}
