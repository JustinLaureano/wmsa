import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Stack, useTheme } from '@mui/material';
import { ShowSortListPartProps } from '@/types';

export default function ShowSortListPart({ sortList } : ShowSortListPartProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(sortList);

    const {
        type,
        status,
        reason,
        percent,
        standard_time,
        cert,
        line_side_sort,
        list_date,
        close_date,
    } = sortList.attributes;

    const {
        customer_name,
        material_part_number,
        material_description,
    } = sortList.computed;

    return (
        <SidebarLayout title={material_part_number}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('quality.sort')}
                    label={`${lang.back_to} ${lang.sort_list}`}
                />
            </Stack>

            <h4>{customer_name}</h4>
            <h4>{material_part_number}</h4>
            <h4>{material_description}</h4>
            <h4>{type}</h4>
            <h4>{status}</h4>
            <h4>{reason}</h4>
            <h4>{percent}</h4>
            <h4>{standard_time}</h4>
            <h4>{cert}</h4>
            <h4>{line_side_sort}</h4>
            <h4>{list_date}</h4>
            <h4>{close_date}</h4>
        </SidebarLayout>
    );
}
