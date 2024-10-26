import React from 'react';
import { Search } from '@mui/icons-material';
import { Chip, Button, Box, useTheme } from '@mui/material';
import { grey } from '@mui/material/colors';

export default function SearchButton(props : Record<string, any>) {
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
            Search...

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
