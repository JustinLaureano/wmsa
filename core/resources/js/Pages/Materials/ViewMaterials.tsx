import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';

interface ViewMaterialsProps {}

export default function ViewMaterials({ ...props } : ViewMaterialsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <MaterialsPageHeader />
        </DashboardLayout>
    );
}
