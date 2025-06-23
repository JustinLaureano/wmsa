import { NavigationTab } from '@/types';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

const tabs : NavigationTab[] = [
    {
        label: 'Plant 2',
        route: route('quality.sort.inventory', { storage_location_building_id: 1 }),
        selected: [
            route('quality.sort.inventory', { storage_location_building_id: 1 }),
        ]
    },
    {
        label: 'Blackhawk',
        route: route('quality.sort.inventory', { storage_location_building_id: 2 }),
        selected: [
            route('quality.sort.inventory', { storage_location_building_id: 2 }),
        ]
    }
]

export default function SortInventoryNavTabs() {
    return (
        <SubpageNavigationTabs
            tabs={tabs}
            centered
            sx={{ mb: 4 }}
        />
    )
}
