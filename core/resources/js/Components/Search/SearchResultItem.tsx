import { InsertDriveFileOutlined, LaunchOutlined } from "@mui/icons-material";
import { Box, ListItemButton, Stack, Typography } from "@mui/material";
import { Link, router } from '@inertiajs/react';
import { RecentSearchService } from "@/Services/Search";
import { SearchResultItemProps } from "@/types/components/search";

export default function SearchResultItem({
    primaryText,
    secondaryText,
    url
}: SearchResultItemProps) {
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

    return (
        <ListItemButton
            component={Link}
            href={url}
            onClick={handleClick}
        >
            <Stack
                direction="row"
                alignItems="center"
                spacing={2}
                sx={{
                    width: '100%',
                    py: 1
                }}
            >
                <Box>
                    <InsertDriveFileOutlined
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
                    <Typography variant="body2" color="text.secondary">
                        {secondaryText}
                    </Typography>
                </Box>
                <Box>
                    <LaunchOutlined
                        fontSize="large"
                        sx={{
                            color: 'text.secondary',
                        }}
                    />
                </Box>
            </Stack>
        </ListItemButton>
    );
}