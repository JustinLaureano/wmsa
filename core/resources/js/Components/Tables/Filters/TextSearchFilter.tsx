import { Search } from "@mui/icons-material";
import { Box, Divider, InputBase, Paper, Stack, Typography } from "@mui/material";

interface TextSearchFilterProps {
    field: string;
    label?: string;
    placeholder?: string;
    onFilterChange: (field: string, value: string) => void;
}

export default function TextSearchFilter({
    field,
    label = '',
    placeholder = 'Search...',
    onFilterChange,
    ...props
} : TextSearchFilterProps) {    

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        onFilterChange(field, e.target.value)
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

                <Typography variant="body2">
                    {label}
                </Typography>

                { 
                    label &&
                    <Divider
                        orientation="vertical"
                        flexItem
                        sx={{ pl: 1 }}
                    />
                }

                <InputBase
                    placeholder={placeholder}
                    inputProps={{ 'aria-label': 'search' }}
                    onChange={handleInputChange}
                    sx={{
                        ml: 1,
                        '.MuiInputBase-input:focus': {
                            boxShadow: 'none'
                        }
                    }}
                />
            </Stack>
        </Paper>
    )
}
