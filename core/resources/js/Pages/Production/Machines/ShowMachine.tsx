import NavigateBackLink from '@/Components/Navigation/NavigateBackLink';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import { Stack, useTheme } from '@mui/material';
import { ShowMachineProps } from '@/types';

export default function ShowMachine({ machine } : ShowMachineProps) {
    const theme = useTheme();
    const { lang } = useLanguage();

    console.log(machine);

    const {
        barcode_label,
        building_name,
        disabled,
        machine_name,
        machine_type_name,
        machine_type_code,
        restrict_request_allocations,
    } = machine.computed;

    return (
        <SidebarLayout title={machine_name}>
            <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>
                <NavigateBackLink
                    route={route('machines')}
                    label={`${lang.back_to} ${lang.machines}`}
                />
            </Stack>

            <h4>{machine_name}</h4>
            <h4>{building_name}</h4>
            <h4>{machine_type_code}</h4>
            <h4>{machine_type_name}</h4>
            <h4>{barcode_label}</h4>
            <h4>{disabled}</h4>
            <h4>{restrict_request_allocations}</h4>
        </SidebarLayout>
    );
}
