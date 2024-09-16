import LanguageContext from '@/Contexts/LanguageContext';
import { Box, ToggleButton, ToggleButtonGroup, Typography, useTheme } from '@mui/material';
import axios from 'axios';
import React, { useContext, useEffect, useState } from 'react';

interface LanguageSettingsProps {

}

export default function LanguageSettings({ ...props } : LanguageSettingsProps) {
    const theme = useTheme();
    const { lang, setLang } = useContext(LanguageContext);
    const [langCode, setLangCode] = useState(lang.lang_code);

    const handleChange = (
        e: React.MouseEvent<HTMLElement>,
        newCode: string
    ) => {
        setLangCode(newCode);
    }

    useEffect(() => {
        axios.post(
                route('localization'),
                {
                    locale: langCode
                }
            )
            .then(res => setLang(res.data.lang))

    }, [langCode])

    return (

        <Box sx={{ p: theme.spacing(2) }}>
            
            <Typography variant="h5">
            {lang.language}
            </Typography>

            <Typography variant="body2">
                {lang.select_your_preferred_language}
            </Typography>

            <ToggleButtonGroup
                color="primary"
                value={langCode}
                exclusive
                onChange={handleChange}
                sx={{
                    mt: theme.spacing(2),
                    mb: theme.spacing(1)
                }}
            >
                <ToggleButton value="en">{lang.english}</ToggleButton>
                <ToggleButton value="es">{lang.spanish}</ToggleButton>
            </ToggleButtonGroup>
        </Box>
    );
}
