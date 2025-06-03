import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import MaterialInventoryData from '@/Domains/Materials/Cards/MaterialInventoryData';
import { ShowMaterialInventoryProps } from '@/types';

export default function ShowMaterialInventory({ inventory, materialOptions, ...props } : ShowMaterialInventoryProps) {
    const { lang } = useContext(LanguageContext);

    console.log(materialOptions);

    return (
        <SidebarLayout title={lang.inventory}>
            <MaterialsPageHeader />

            <MaterialInventoryData inventory={inventory} />
        </SidebarLayout>
    );
}
