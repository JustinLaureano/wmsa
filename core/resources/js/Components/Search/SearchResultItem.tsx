import { JsonObject } from "@/types";
import { InsertDriveFileOutlined, LaunchOutlined } from "@mui/icons-material";
import { Box, ListItemButton, Stack, Typography } from "@mui/material";
import { Link } from '@inertiajs/react';

export default function SearchResultItem({
    primaryText,
    secondaryText,
    url
}: { primaryText: string, secondaryText: string, url: string }) {
    return (
        <ListItemButton
            component={Link}
            href={url}
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