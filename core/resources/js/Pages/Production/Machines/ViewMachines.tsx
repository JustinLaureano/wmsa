import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { ViewMachinesProps } from '@/types';
import ViewMachineDataTable from '@/Domains/Production/Cards/ViewMachineDataTable';

export default function ViewMachines({
    machines,
    ...props
} : ViewMachinesProps) {

    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.materials}>
            <ProductionPageHeader />

            <ViewMachineDataTable
                machines={machines}
            />
        </SidebarLayout>
    );
}
