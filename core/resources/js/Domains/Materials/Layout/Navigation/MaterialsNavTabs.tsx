import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function MaterialsNavTabs() {
    const tabs = [
        {
            label: 'Material Inventory',
            route: route('materials.inventory'),
            selected: [
                route('materials.inventory'),
            ]
        },
        {
            label: 'Full Inventory',
            route: route('containers.inventory'),
            selected: [
                route('containers.inventory'),
            ]
        },
        {
            label: 'View Materials',
            route: route('materials'),
            selected: [
                route('materials'),
            ]
        },
        {
            label: 'Safety Stock',
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
