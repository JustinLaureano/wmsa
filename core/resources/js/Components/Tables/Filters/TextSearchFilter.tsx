import { useState } from "react";
import { Search } from "@mui/icons-material";
import { Box, Divider, Paper, Stack, Typography } from "@mui/material";
import { BaseTextSearchFilterProps } from "@/types";
import StyledInputBase from "@/Components/Styled/StyledInputBase";

export default function TextSearchFilter({
    field,
    label = '',
    operation = 'like',
    placeholder = 'Search...',
    onFilterChange,
    ...props
} : BaseTextSearchFilterProps) {

    const [filterTimeout, setFilterTimeout] = useState<NodeJS.Timeout | null>(null);

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        if (filterTimeout) clearTimeout(filterTimeout);

        setFilterTimeout(setTimeout(() => {
            onFilterChange(field, operation, e.target.value)
        }, 400))
    }

    return (
        <Paper
            elevation={0}
            variant="outlined"
            sx={{
                p: '3px 8px',
                minWidth: '240px',
                boxShadow: 'none'
            }}
        >
            <Stack
                direction="row"
                alignItems="center"
            >
                <Box sx={{ mr: '4px' }}>
                    <Search color="action" fontSize="small" />
                </Box>

                {
                    label &&
                    <Typography variant="body2">
                        {label}
                    </Typography>
                }

                {
                    label &&
                    <Divider
                        orientation="vertical"
                        flexItem
                        sx={{ pl: 1 }}
                    />
                }

                <StyledInputBase
                    placeholder={placeholder}
                    inputProps={{ 'aria-label': 'search' }}
                    onChange={handleInputChange}
                />
            </Stack>
        </Paper>
    )
}
