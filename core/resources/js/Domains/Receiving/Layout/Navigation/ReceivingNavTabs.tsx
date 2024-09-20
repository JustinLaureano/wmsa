import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function ReceivingNavTabs(props : Record<string, any>) {
    const tabs = [
        { label: 'View Documents', route: route('receiving.documents') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
