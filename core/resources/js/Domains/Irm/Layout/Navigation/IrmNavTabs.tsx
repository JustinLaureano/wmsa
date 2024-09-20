import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function IrmNavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Inventory', route: route('irm.chemicals.inventory') },
        { label: 'View Chemicals', route: route('irm.chemicals') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
