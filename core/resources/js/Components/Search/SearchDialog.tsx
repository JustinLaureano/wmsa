import { useState } from 'react';
import {
    CircularProgress,
	Dialog,
	DialogActions,
	DialogContent,
    Divider,
    Stack,
} from '@mui/material';
import { JsonObject, SearchDialogProps } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import SearchInput from './SearchInput';
import { SearchService } from '@/Services/SearchService';
import NoSearchResults from './NoSearchResults';
import LoadingIndicator from './LoadingIndicator';
import SearchResults from './SearchResults';

export default function SearchDialog({ open, onClose }: SearchDialogProps) {
	const { lang } = useLanguage();
    const searchService = new SearchService();

    const [results, setResults] = useState<JsonObject | null>(null);
    const [isLoading, setIsLoading] = useState(false);
    const [searchTimeout, setSearchTimeout] = useState<NodeJS.Timeout | null>(null);

    const handleSearchChange = (value: string) => {
        // TODO: set to state so a clear button can be used to clear the search
        if (searchTimeout) clearTimeout(searchTimeout);

        setSearchTimeout(setTimeout(() => {
            handleSearch(value);
        }, 200));
    }

    const handleSearch = async (value: string) => {
        setIsLoading(true);

        const response = await searchService.search(value);

        setIsLoading(false);

        if (response && Object.keys(response.results).length > 0) {
            setResults(response.results);
        }
        else {
            setResults(null);
        }
    }

	return (
		<Dialog
            open={open}
            onClose={onClose}
            fullWidth
            maxWidth="sm"
            sx={{
                // height: '300px',
                '& .MuiDialogContent-root': {
                    padding: 0,
                },
            }}
        >
			<DialogContent dividers>
                <SearchInput
                    onChange={handleSearchChange}
                />
                <Divider />
                {
                    (!results) &&
                    <NoSearchResults />
                }
                {
                    results &&
                    <SearchResults results={results} />
                }
			</DialogContent>
            <DialogActions>
                <LoadingIndicator isLoading={isLoading} />
            </DialogActions>
		</Dialog>
	);
};
