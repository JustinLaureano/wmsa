import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { ShowContainerProps } from '@/types';
import { Stack, useTheme } from '@mui/material';
import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';

export default function ShowMaterialContainer({ container } : ShowContainerProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(container)

    // TODO: style page properly
    const {
        container_type_name,
        container_tote_type_name,
        movement_status,
        part_number,
        barcode_label,
    } = container.computed;

    return (
        <SidebarLayout title={part_number}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('containers.inventory')}
                    label={`${lang.back_to} ${lang.full_inventory}`}
                />
            </Stack>

            <h4>{part_number}</h4>
            <h4>{container_tote_type_name}</h4>
            <h4>{container_type_name}</h4>
            <h4>{movement_status}</h4>
            <h4>{barcode_label.barcode}</h4>
        </SidebarLayout>
    );
}
