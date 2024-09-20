import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import PageHeader from '@/Domains/Materials/Layout/Header/PageHeader';

interface ViewMaterialsProps {}

export default function ViewMaterials({ ...props } : ViewMaterialsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <PageHeader />
        </DashboardLayout>
    );
}
