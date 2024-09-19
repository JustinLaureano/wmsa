import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function NavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'Inventory', route: route('materials.inventory') },
        { label: 'Create Material', route: route('materials.create') }, // TODO: change route
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
