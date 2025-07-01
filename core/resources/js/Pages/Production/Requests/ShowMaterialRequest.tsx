import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Stack, useTheme } from '@mui/material';
import { ShowMaterialRequestProps } from '@/types';

export default function ShowMaterialRequest({ materialRequest } : ShowMaterialRequestProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(materialRequest);

    const {
        title,
        requester_name,
        requested_at,
        status,
    } = materialRequest.computed;

    return (
        <SidebarLayout title={title}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('production.requests', { building_id: 1, type: 'transfer' })}
                    label={`${lang.back_to} ${lang.material_requests}`}
                />
            </Stack>

            <h4>{title}</h4>
            <h4>{requester_name}</h4>
            <h4>{requested_at}</h4>
            <h4>{status}</h4>
        </SidebarLayout>
    );
}
