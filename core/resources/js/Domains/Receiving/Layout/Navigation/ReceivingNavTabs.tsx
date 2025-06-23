import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ReceivingNavTabs() {
    const tabs = [
        {
            label: 'View Documents',
            route: route('receiving.documents'),
            selected: [
                route('receiving.documents'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
