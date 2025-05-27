import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ShowInventoryProps } from '@/Domains/Materials/types';
import InventoryDataTable from '@/Domains/Materials/Cards/InventoryDataTable';

export default function ShowInventory({ inventory, ...props } : ShowInventoryProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <MaterialsPageHeader />

            <InventoryDataTable inventory={inventory} />
        </SidebarLayout>
    );
}
