import { useState } from 'react';
import {
	Dialog,
	DialogActions,
	DialogContent,
    Divider
} from '@mui/material';
import { JsonObject, SearchDialogProps } from '@/types';
import SearchInput from './SearchInput';
import { SearchService } from '@/Services/Search';
import NoSearchResults from './NoSearchResults';
import LoadingIndicator from './LoadingIndicator';
import SearchResults from './SearchResults';

export default function SearchDialog({ open, onClose }: SearchDialogProps) {
    const searchService = new SearchService();

    const [results, setResults] = useState<JsonObject | null>(null);
    const [isLoading, setIsLoading] = useState(false);
    const [searchTimeout, setSearchTimeout] = useState<NodeJS.Timeout | null>(null);

    const handleSearchChange = (value: string) => {
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
