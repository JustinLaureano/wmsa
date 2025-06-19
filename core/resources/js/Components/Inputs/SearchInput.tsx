import { useState } from "react";
import { Search } from "@mui/icons-material";
import { Box, Divider, Paper, Stack, Typography } from "@mui/material";
import { SearchInputProps } from "@/types";
import StyledInputBase from "@/Components/Styled/StyledInputBase";

export default function SearchInput({
    label = '',
    value,
    onChange,
    placeholder = 'Search...',
    ...props
} : SearchInputProps) {
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
                    onChange={onChange}
                />
            </Stack>
        </Paper>
    )
}