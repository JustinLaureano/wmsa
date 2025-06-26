import { useContext } from "react";
import {
    Box,
    Typography,
} from "@mui/material";
import LanguageContext from "@/Contexts/LanguageContext";

export default function UserProfileCardHeader() {
    const { lang } = useContext(LanguageContext);

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