import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ShowMaterialProps } from '@/types';

export default function ShowMaterial({
    material,
    ...props
} : ShowMaterialProps) {
    const { lang } = useContext(LanguageContext);

    console.log(material)

    // TODO: fix header and style page properly

    return (
        <SidebarLayout title={material.part_number}>
            <MaterialsPageHeader />

            <h4>{material.material_number}</h4>
            <h4>{material.part_number}</h4>
            <h4>{material.description}</h4>
        </SidebarLayout>
    );
}
