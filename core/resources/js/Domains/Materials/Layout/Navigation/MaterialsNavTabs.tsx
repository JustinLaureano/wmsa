import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function MaterialsNavTabs() {
    const tabs = [
        { label: 'Material Inventory', route: route('materials.inventory') },
        { label: 'Full Inventory', route: route('containers.inventory') },
        { label: 'View Materials', route: route('materials') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
