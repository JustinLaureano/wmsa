import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ProductionNavTabs() {
    const tabs = [
        { label: 'Material Requests', route: route('production.requests', { building_id: 1, type: 'transfer' }) },
        { label: 'New Request', route: route('production.material-request.new') },
        { label: 'Put Away', route: route('production.put-away.scan') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
