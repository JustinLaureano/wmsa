import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';

interface ShowInventoryProps {}

export default function ShowInventory({ ...props } : ShowInventoryProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <MaterialsPageHeader />
        </DashboardLayout>
    );
}
