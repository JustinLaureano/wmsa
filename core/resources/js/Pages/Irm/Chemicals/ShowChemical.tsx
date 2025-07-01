import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Stack, useTheme } from '@mui/material';
import { ShowChemicalProps } from '@/types';

export default function ShowChemical({ chemical } : ShowChemicalProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(chemical);

    const {
        material_part_number,
        material_description,
        base_unit_of_measure,
        material_container_type_name,
        assigned_storage_location_name,
        drop_off_storage_location_name,
    } = chemical.computed;

    return (
        <SidebarLayout title={material_part_number}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('irm.chemicals')}
                    label={`${lang.back_to} ${lang.irm_chemicals}`}
                />
            </Stack>

            <h4>{material_part_number}</h4>
            <h4>{material_description}</h4>
            <h4>{base_unit_of_measure}</h4>
            <h4>{material_container_type_name}</h4>
            <h4>{assigned_storage_location_name}</h4>
            <h4>{drop_off_storage_location_name}</h4>
        </SidebarLayout>
    );
}
