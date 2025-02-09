import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
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
        <SidebarLayout title={lang.materials}>
            <MaterialsPageHeader />

            <MaterialDataTable
                materials={materials}
            />
        </SidebarLayout>
    );
}
