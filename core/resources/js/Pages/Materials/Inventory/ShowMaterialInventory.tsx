import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ShowMaterialInventoryProps } from '@/types';

export default function ShowMaterialInventory({ inventory, ...props } : ShowMaterialInventoryProps) {
    const { lang } = useContext(LanguageContext);

    console.log(inventory);

    return (
        <SidebarLayout title={lang.inventory}>
            <MaterialsPageHeader />

            <h1>Material Inventory</h1>
        </SidebarLayout>
    );
}
