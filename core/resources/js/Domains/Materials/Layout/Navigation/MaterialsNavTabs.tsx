import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function MaterialsNavTabs() {
    const { lang } = useContext(LanguageContext);

    const tabs = [
        {
            label: lang.material_inventory,
            route: route('materials.inventory'),
            selected: [
                route('materials.inventory'),
            ]
        },
        {
            label: lang.full_inventory,
            route: route('containers.inventory'),
            selected: [
                route('containers.inventory'),
            ]
        },
        {
            label: lang.view_materials,
            route: route('materials'),
            selected: [
                route('materials'),
            ]
        },
        {
            label: lang.safety_stock,
            route: route('materials.safety-stock'),
            selected: [
                route('materials.safety-stock'),
                route('materials.safety-stock', { material_type_code: 'COMP' }),
                route('materials.safety-stock', { material_type_code: 'CMET' }),
                route('materials.safety-stock', { material_type_code: 'IRM' }),
            ]
        }
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
