import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ShowInventoryProps } from '@/Domains/Materials/types';
import ContainerInventoryDataTable from '@/Domains/Materials/Cards/ContainerInventoryDataTable';

export default function ShowContainerInventory({ inventory, ...props } : ShowInventoryProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <MaterialsPageHeader />

            <ContainerInventoryDataTable inventory={inventory} />
        </SidebarLayout>
    );
}
