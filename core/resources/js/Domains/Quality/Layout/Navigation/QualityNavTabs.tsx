import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function QualityNavTabs() {
    const tabs = [
        { label: 'Sort List', route: route('quality.sort') },
        { label: 'Sort Parts', route: route('quality.sort.part-numbers') },
        { label: 'Sort Inventory', route: route('quality.sort.inventory', { storage_location_building_id: 1 }) },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
