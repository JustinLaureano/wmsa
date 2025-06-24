import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function QualityNavTabs() {
    const { lang } = useContext(LanguageContext);

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
