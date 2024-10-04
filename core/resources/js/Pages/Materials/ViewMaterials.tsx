import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ViewMaterialsProps } from '@/Domains/Materials/types';
import MaterialDataTable from '@/Domains/Materials/Cards/MaterialDataTable';

export default function ViewMaterials({
    materials,
    ...props
} : ViewMaterialsProps) {

    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.materials}>
            <MaterialsPageHeader />

            <MaterialDataTable
                materials={materials}
            />
        </DashboardLayout>
    );
}
