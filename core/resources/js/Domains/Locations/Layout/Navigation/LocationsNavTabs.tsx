import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function LocationsNavTabs() {
    const tabs = [
        { label: 'Warehouse KPI', route: route('locations.buildings.kpi') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
