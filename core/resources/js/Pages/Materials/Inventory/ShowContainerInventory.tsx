import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ShowContainerInventoryProps } from '@/types';
import ContainerInventoryDataTable from '@/Domains/Materials/Cards/ContainerInventoryDataTable';

export default function ShowContainerInventory({ inventory, ...props } : ShowContainerInventoryProps) {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.inventory}>
            <MaterialsPageHeader />

            <ContainerInventoryDataTable inventory={inventory} />
        </SidebarLayout>
    );
}
