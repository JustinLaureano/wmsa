import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function NavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Material Requests', route: route('production.requests') },
        { label: 'New Request', route: route('production.requests.create') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
