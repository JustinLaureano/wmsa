import { useContext } from 'react';
import { JsonObject, NavigationTab } from '@/types';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

const tabs = (lang: JsonObject) : NavigationTab[] => {
    return [
        {
            label: lang.plant_2,
            route: route('quality.sort.inventory', { storage_location_building_id: 1 }),
            selected: [
                route('quality.sort.inventory', { storage_location_building_id: 1 }),
            ]
        },
        {
            label: lang.blackhawk,
            route: route('quality.sort.inventory', { storage_location_building_id: 2 }),
            selected: [
                route('quality.sort.inventory', { storage_location_building_id: 2 }),
            ]
        }
    ]
}

export default function SortInventoryNavTabs() {
    const { lang } = useContext(LanguageContext);

    return (
        <SubpageNavigationTabs
            tabs={tabs(lang)}
            centered
            sx={{ mb: 4 }}
        />
    )
}
