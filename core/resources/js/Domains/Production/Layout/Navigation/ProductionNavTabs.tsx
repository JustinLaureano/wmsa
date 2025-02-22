import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ProductionNavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Material Requests', route: route('production.requests') },
        { label: 'New Request', route: route('production.material-request.new') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
