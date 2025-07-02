import { useState } from "react";
import { IconButton, Stack } from "@mui/material";
import StyledInputBase from "../Styled/StyledInputBase";
import { useLanguage } from "@/Providers/LanguageProvider";
import { Clear, Search } from "@mui/icons-material";
import { SearchDialogInputProps } from "@/types";

export default function SearchInput({ onChange }: SearchDialogInputProps) {
    const { lang } = useLanguage();

    const [searchValue, setSearchValue] = useState('');

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSearchValue(e.target.value.trim());
        onChange(e.target.value.trim());
    }

    const handleClear = (e: React.MouseEvent<HTMLButtonElement>) => {
        setSearchValue('');
        onChange('');
    }

    return (
        <Stack
            direction="row"
            alignItems="center"
            spacing={3}
            sx={{
                px: 3,
                py: 2,
            }}
        >
            <Search fontSize="large" />

            <StyledInputBase
                value={searchValue}
                autoFocus
                onChange={handleChange}
                placeholder={`${lang.search}...`}
                inputProps={{ 'aria-label': 'search' }}
                sx={{
                    flexGrow: 1,
                }}
            />

            {
                searchValue &&
                <IconButton
                    onClick={handleClear}
                    sx={{
                        color: 'text.secondary',
                        '&:hover': {
                            color: 'text.primary',
                        },
                    }}
                >
                    <Clear />
                </IconButton>
            }
        </Stack>
    );
}
