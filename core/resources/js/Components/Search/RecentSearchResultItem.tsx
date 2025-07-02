import { Clear, HistoryOutlined } from "@mui/icons-material";
import {
    Box,
    IconButton,
    ListItemButton,
    Stack,
    Typography,
    Tooltip
} from "@mui/material";
import { Link, router } from '@inertiajs/react';
import { RecentSearchService } from "@/Services/Search";
import { RecentSearchResultItemProps } from "@/types/components/search";
import { useLanguage } from "@/Providers/LanguageProvider";

export default function RecentSearchResultItem({
    primaryText,
    secondaryText,
    url,
    onClearRecentSearch
}: RecentSearchResultItemProps) {
    const { lang } = useLanguage();

    const recentSearchService = new RecentSearchService();

    const handleClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
        e.preventDefault();

        const searchItem = {
            primaryText,
            secondaryText,
            url
        };

        recentSearchService.addRecentSearch(searchItem);
        router.get(url);
    }

    const handleClearRecentSearch = () => {
        recentSearchService.removeRecentSearch(url);
        onClearRecentSearch();
    }

    return (
        <ListItemButton>
            <Stack
                direction="row"
                alignItems="center"
                spacing={2}
                sx={{ width: '100%' }}
            >
                <Box sx={{ width: '100%' }}>
                    <Link href={url} onClick={handleClick}>
                        <Stack
                            direction="row"
                            alignItems="center"
                            spacing={2}
                            sx={{ py: 1, width: '100%' }}
                        >
                            <Box>
                                <HistoryOutlined
                                    fontSize="large"
                                    sx={{
                                        color: 'text.secondary',
                                    }}
                                />
                            </Box>
                            <Box flexGrow={1}>
                                <Typography variant="body1">
                                    {primaryText}
                                </Typography>
                                <Typography
                                    variant="body2"
                                    color="text.secondary"
                                >
                                    {secondaryText}
                                </Typography>
                            </Box>
                        </Stack>
                    </Link>
                </Box>

                <Box>
                    <Tooltip
                        arrow
                        title={lang.clear_recent_search}
                    >
                        <IconButton
                            onClick={handleClearRecentSearch}
                        >
                            <Clear
                                fontSize="large"
                                sx={{
                                    zIndex: 1000,
                                    color: 'text.secondary',
                                    '&:hover': {
                                        color: 'text.primary',
                                    }
                                }}
                                />
                        </IconButton>
                    </Tooltip>
                </Box>
            </Stack>
        </ListItemButton>
    );
}