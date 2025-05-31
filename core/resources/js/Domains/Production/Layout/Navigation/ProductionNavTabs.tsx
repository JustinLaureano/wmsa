import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ProductionNavTabs() {
    const tabs = [
        { label: 'Material Requests', route: route('production.requests', { building_id: 1, type: 'transfer' }) },
        { label: 'New Request', route: route('production.material-request.new') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
