import React, { useState } from 'react';
import { JsonObject } from '@/types';
import { Search } from '@mui/icons-material';
import { Button, Typography, useTheme } from '@mui/material';
import { useLanguage } from '@/Providers/LanguageProvider';
import SearchDialog from './SearchDialog';
import SearchShortcutChip from './SearchShortcutChip';

export default function SearchButton(props : JsonObject) {
    const { lang } = useLanguage();
    const theme = useTheme();

    const [searchDialogOpen, setSearchDialogOpen] = useState(false);
    const handleSearchDialogOpen = () => setSearchDialogOpen(true);
    const handleSearchDialogClose = () => setSearchDialogOpen(false);

    React.useEffect(() => {
        const handleKeyDown = (event: KeyboardEvent) => {
            if (event.altKey && event.key === 'k') {
                event.preventDefault();
                handleSearchDialogOpen();
            }
        };

        document.addEventListener('keydown', handleKeyDown);

        return () => {
            document.removeEventListener('keydown', handleKeyDown);
        };
    }, []);

    return (
        <>
            <Button
                variant="outlined"
                color="info"
                startIcon={<Search />}
                onClick={handleSearchDialogOpen}
                sx={{
                    borderRadius: 4,
                    textTransform: 'none',
                }}
            >
                <Typography variant="subtitle2" fontWeight={400}>
                    {lang.search}...
                </Typography>

                <SearchShortcutChip />
            </Button>

            <SearchDialog
                open={searchDialogOpen}
                onClose={handleSearchDialogClose}
            />
        </>
    );
}
