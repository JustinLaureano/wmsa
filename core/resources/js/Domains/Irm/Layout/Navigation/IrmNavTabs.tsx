import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function IrmNavTabs() {
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
