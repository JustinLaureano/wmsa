import { Stack, Typography } from "@mui/material";
import { useLanguage } from "@/Providers/LanguageProvider";

export default function NoSearchResults() {
    const { lang } = useLanguage();

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