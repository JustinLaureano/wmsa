import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ViewMaterialsProps } from '@/types';
import MaterialDataTable from '@/Domains/Materials/Cards/MaterialDataTable';

export default function ViewMaterials({
    materials,
    ...props
} : ViewMaterialsProps) {

    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.materials}>
            <MaterialsPageHeader />

            <MaterialDataTable
                materials={materials}
            />
        </SidebarLayout>
    );
}
