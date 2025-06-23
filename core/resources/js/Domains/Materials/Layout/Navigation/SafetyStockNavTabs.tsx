import { NavigationTab } from '@/types';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

const tabs : NavigationTab[] = [
    {
        label: 'All',
        route: route('materials.safety-stock'),
        selected: [
            route('materials.safety-stock'),
        ]
    },
    {
        label: 'COMP',
        route: route('materials.safety-stock', { material_type_code: 'COMP' }),
        selected: [
            route('materials.safety-stock', { material_type_code: 'COMP' }),
        ]
    },
    {
        label: 'CMET',
        route: route('materials.safety-stock', { material_type_code: 'CMET' }),
        selected: [
            route('materials.safety-stock', { material_type_code: 'CMET' }),
        ]
    },
    {
        label: 'IRM',
        route: route('materials.safety-stock', { material_type_code: 'IRM' }),
        selected: [
            route('materials.safety-stock', { material_type_code: 'IRM' }),
        ]
    },
]

export default function SafetyStockNavTabs() {
    return (
        <SubpageNavigationTabs
            tabs={tabs}
            centered
            sx={{ mb: 4 }}
        />
    )
}
