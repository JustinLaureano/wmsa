import React, { useContext, useEffect, useState } from 'react';
import axios from 'axios';
import LanguageContext from '@/Contexts/LanguageContext';
import { Box, ToggleButton, ToggleButtonGroup, Typography, useTheme } from '@mui/material';

export default function LanguageSettings() {
    const theme = useTheme();
    const [initialLoad, setInitialLoad] = useState(true);
    const { lang, setLang } = useContext(LanguageContext);
    const [langCode, setLangCode] = useState(lang.lang_code);

    const handleChange = (
        e: React.MouseEvent<HTMLElement>,
        newCode: string
    ) => {
        setLangCode(newCode);
    }

    useEffect(() => {
        if (initialLoad) {
            setInitialLoad(false);
            return;
        }

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
