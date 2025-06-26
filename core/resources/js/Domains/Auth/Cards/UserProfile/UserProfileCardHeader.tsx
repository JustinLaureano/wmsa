import {
    Box,
    Typography,
} from "@mui/material";
import { useLanguage } from "@/Providers/LanguageProvider";

export default function UserProfileCardHeader() {
    const { lang } = useLanguage();

    return (
        <Box
            sx={{
                px: 3,
                py: 2,
                borderBottom: 1,
                borderColor: 'divider',
                bgcolor: 'primary.main',
                color: 'primary.contrastText',
            }}
        >
            <Typography variant="h4">
                {lang.user_profile}
            </Typography>
        </Box>
    )
}