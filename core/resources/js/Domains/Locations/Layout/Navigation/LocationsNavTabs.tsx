import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function LocationsNavTabs() {
    const { lang } = useContext(LanguageContext);

    const tabs = [
        {
            label: 'Warehouse KPI',
            route: route('locations.buildings.kpi'),
            selected: [
                route('locations.buildings.kpi'),
            ]
        },
        {
            label: lang.storage_locations,
            route: route('locations.show'),
            selected: [
                route('locations.show'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
