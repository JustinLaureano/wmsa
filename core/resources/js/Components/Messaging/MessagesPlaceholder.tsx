import { useContext } from 'react';
import { MailOutline } from '@mui/icons-material';
import { Stack, Typography, useTheme} from '@mui/material';
import { grey } from '@mui/material/colors';
import LanguageContext from '@/Contexts/LanguageContext';

export default function MessagesPlaceholder() {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    const color = theme.palette.mode == 'light'
        ? grey[200]
        : theme.palette.background.default;

    return (
        <Stack
            alignItems="center"
            justifyContent="center"
            flexGrow={1}
        >
            <Stack
                alignItems="center"
                justifyContent="center"
            >
                <MailOutline
                    sx={{
                        fontSize: '300px',
                        color: color
                    }}
                />
                <Typography
                    variant="h3"
                    sx={{ color: theme.palette.text.disabled }}
                >
                    {lang.select_or_start_a_conversation}
                </Typography>
            </Stack>
        </Stack>
    );
}
