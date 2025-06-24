import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ProductionNavTabs() {
    const tabs = [
        {
            label: 'Material Requests',
            route: route('production.requests', { building_id: 1, type: 'transfer' }),
            selected: [
                route('production.requests', { building_id: 1, type: 'transfer' }),
                route('production.requests', { building_id: 2, type: 'transfer' }),
                route('production.requests', { building_id: 3, type: 'transfer' }),
                route('production.requests', { building_id: 1, type: 'phosphate' }),
                route('production.requests', { building_id: 2, type: 'shipping' }),
            ]
        },
        {
            label: 'New Request',
            route: route('production.material-request.new'),
            selected: [
                route('production.material-request.new'),
            ]
        },
        {
            label: 'Put Away',
            route: route('production.put-away.scan'),
            selected: [
                route('production.put-away.scan'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
