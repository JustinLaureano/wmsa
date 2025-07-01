import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Stack, useTheme } from '@mui/material';
import { ShowStorageLocationProps } from '@/types';

export default function ShowStorageLocation({ location } : ShowStorageLocationProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(location);

    const {
        name
    } = location.attributes;

    const {
        maximum_container_count,
        container_count,
        location_type,
    } = location.computed;

    return (
        <SidebarLayout title={name}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('locations.index')}
                    label={`${lang.back_to} ${lang.storage_locations}`}
                />
            </Stack>

            <h4>{name}</h4>
            <h4>{maximum_container_count}</h4>
            <h4>{container_count}</h4>
            <h4>{location_type}</h4>
        </SidebarLayout>
    );
}
