import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function LocationsNavTabs() {
    const { lang } = useLanguage();

    const tabs = [
        {
            label: lang.warehouse_kpi,
            route: route('locations.buildings.kpi'),
            selected: [
                route('locations.buildings.kpi'),
            ]
        },
        {
            label: lang.storage_locations,
            route: route('locations.index'),
            selected: [
                route('locations.index'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
