import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';

export default function QualityNavTabs() {
    const tabs = [
        { label: 'Sort List', route: route('quality.sort') },
        { label: 'Sort Parts', route: route('quality.sort.part-numbers') },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
