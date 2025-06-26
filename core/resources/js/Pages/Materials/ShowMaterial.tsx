import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { ShowMaterialProps } from '@/types';
import { Stack, useTheme } from '@mui/material';
import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';

export default function ShowMaterial({
    material,
    ...props
} : ShowMaterialProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(material)

    // TODO: style page properly

    return (
        <SidebarLayout title={material.part_number}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('materials')}
                    label={`${lang.back_to} ${lang.materials}`}
                />
            </Stack>

            <h4>{material.material_number}</h4>
            <h4>{material.part_number}</h4>
            <h4>{material.description}</h4>
        </SidebarLayout>
    );
}
