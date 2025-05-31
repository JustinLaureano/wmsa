import { useContext } from 'react';
import { ShowInventoryProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import IrmPageHeader from '@/Domains/Irm/Layout/Header/IrmPageHeader';

export default function ShowInventory({ ...props } : ShowInventoryProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <IrmPageHeader />
        </SidebarLayout>
    );
}
