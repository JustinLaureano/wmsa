import React, { useContext } from 'react';
import { JsonObject } from '@/types';
import { Search } from '@mui/icons-material';
import { Button, Box, useTheme } from '@mui/material';
import { grey } from '@mui/material/colors';
import LanguageContext from '@/Contexts/LanguageContext';

export default function SearchButton(props : JsonObject) {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    const handleButtonClick= (e: React.MouseEvent<HTMLElement>) => {
        console.log('needes implemented')
    }

    return (
        <Button
            size="small"
            variant="outlined"
            startIcon={<Search />}
            onClick={handleButtonClick}
            sx={{
                borderRadius: 4,
                textTransform: 'none',
            }}
        >
            {lang.search}...

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
        </Button>
    );
}
