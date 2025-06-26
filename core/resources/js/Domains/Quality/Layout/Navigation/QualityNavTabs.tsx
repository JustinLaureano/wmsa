import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function QualityNavTabs() {
    const { lang } = useLanguage();

    const tabs = [
        {
            label: lang.sort_list,
            route: route('quality.sort'),
            selected: [
                route('quality.sort'),
            ]
        },
        {
            label: lang.sort_parts,
            route: route('quality.sort.part-numbers'),
            selected: [
                route('quality.sort.part-numbers'),
            ]
        },
        {
            label: lang.sort_inventory,
            route: route('quality.sort.inventory', { storage_location_building_id: 1 }),
            selected: [
                route('quality.sort.inventory', { storage_location_building_id: 1 }),
                route('quality.sort.inventory', { storage_location_building_id: 2 }),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
