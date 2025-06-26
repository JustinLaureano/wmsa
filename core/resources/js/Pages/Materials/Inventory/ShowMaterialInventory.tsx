import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import MaterialInventoryData from '@/Domains/Materials/Cards/MaterialInventoryData';
import { ShowMaterialInventoryProps } from '@/types';

export default function ShowMaterialInventory({ inventory, materialOptions, ...props } : ShowMaterialInventoryProps) {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.inventory}>
            <MaterialsPageHeader />

            <MaterialInventoryData
                inventory={inventory}
                materialOptions={materialOptions}
            />
        </SidebarLayout>
    );
}
