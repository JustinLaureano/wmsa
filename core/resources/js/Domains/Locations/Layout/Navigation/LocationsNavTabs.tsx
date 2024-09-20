import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function LocationsNavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Warehouse KPI', route: route('locations.buildings.kpi') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
