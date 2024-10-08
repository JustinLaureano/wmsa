import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function MaterialsNavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Inventory', route: route('materials.inventory') },
        { label: 'View Materials', route: route('materials') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
