import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import PageHeader from '@/Domains/Materials/Layout/Header/PageHeader';

interface ShowInventoryProps {}

export default function ShowInventory({ ...props } : ShowInventoryProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <PageHeader />
        </DashboardLayout>
    );
}
