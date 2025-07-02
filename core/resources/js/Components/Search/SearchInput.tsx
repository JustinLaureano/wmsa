import { Stack } from "@mui/material";
import StyledInputBase from "../Styled/StyledInputBase";
import { useLanguage } from "@/Providers/LanguageProvider";
import { Search } from "@mui/icons-material";
import { SearchDialogInputProps } from "@/types";

export default function SearchInput({ onChange }: SearchDialogInputProps) {
    const { lang } = useLanguage();

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        onChange(e.target.value.trim());
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
                autoFocus
                onChange={handleChange}
                placeholder={`${lang.search}...`}
                inputProps={{ 'aria-label': 'search' }}
                sx={{
                    flexGrow: 1,
                }}
            />
        </Stack>
    );
}
