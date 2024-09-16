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
            color="gray"
            variant="outlined"
            startIcon={<Search />}
            onClick={handleButtonClick}
            sx={{
                borderColor: grey[300],
                borderRadius: 4,
                textTransform: 'none',
                '&:hover': {
                    borderColor: grey[300]
                }
            }}
        >
            Search...
            &nbsp;

            <Box
                component="span"
                sx={{
                    background: grey[200],
                    padding: '1px 8px',
                    marginLeft: theme.spacing(1),
                    borderRadius: 2,
                    fontSize: '.675rem'
                }}
            >
                Ctrl + P
            </Box>
        </Button>

    );
}
