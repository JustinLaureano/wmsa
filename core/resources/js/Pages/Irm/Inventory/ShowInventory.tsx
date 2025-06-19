import { useContext } from 'react';
import { ShowInventoryProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import IrmPageHeader from '@/Domains/Irm/Layout/Header/IrmPageHeader';
import IrmChemicalInventoryData from '@/Domains/Irm/Cards/IrmChemicalInventoryData';

export default function ShowInventory({ inventory } : ShowInventoryProps) {
    const { lang } = useContext(LanguageContext);

    console.log(inventory);

    return (
        <SidebarLayout title={lang.inventory}>
            <IrmPageHeader />

            <IrmChemicalInventoryData inventory={inventory} />
        </SidebarLayout>
    );
}
