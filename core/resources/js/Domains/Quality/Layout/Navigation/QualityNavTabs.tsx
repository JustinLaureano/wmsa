import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function QualityNavTabs() {
    const tabs = [
        { label: 'Sort List', route: route('quality.sort') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
