import { useState } from "react";
import { Box, List, Stack, Typography } from "@mui/material";
import { useLanguage } from "@/Providers/LanguageProvider";
import { RecentSearchService } from "@/Services/Search";
import { JsonObject } from "@/types";
import SearchResultCategoryHeader from "./SearchResultCategoryHeader";
import RecentSearchResultItem from "./RecentSearchResultItem";

export default function NoSearchResults() {
    const { lang } = useLanguage();

    const recentSearchService = new RecentSearchService();

    const [recentSearches, setRecentSearches] = useState(recentSearchService.getRecentSearches() || null);

    const handleClearRecentSearch = () => {
        setRecentSearches(recentSearchService.getRecentSearches() || null);
    }

    if (recentSearches && recentSearches.length > 0) {
        return (
            <Box sx={{ py: 2, px: 3 }}>
                <SearchResultCategoryHeader title={lang.recent} />
                <List>
                    {recentSearches.map((search: JsonObject, index: number) => (

                    <RecentSearchResultItem
                        key={`recent_search_${index}`}
                        primaryText={search.primaryText}
                        secondaryText={search.secondaryText}
                        url={search.url}
                        onClearRecentSearch={handleClearRecentSearch}
                    />
                ))}
                </List>
            </Box>
        );
    }
    else {
        return (
            <Stack
                alignItems="center"
                justifyContent="center"
                sx={{
                    padding: 6,
                }}
            >
                <Typography variant="body2" color="text.secondary">
                    {lang.no_recent_searches}
                </Typography>
            </Stack>
        );
    }

}