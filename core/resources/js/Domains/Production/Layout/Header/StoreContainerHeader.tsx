import { Stack, Typography, useTheme } from '@mui/material';
import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function StoreContainerHeader() {
    const { lang } = useLanguage();
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
            <NavigateBackLink
                route={route('production.put-away.scan')}
                label={`${lang.back_to} ${lang.scan}`}
            />

            <Typography variant="h3">{lang.store_container}</Typography>
        </Stack>
    )
}
