import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function ProductionNavTabs() {
    const { lang } = useContext(LanguageContext);

    const tabs = [
        {
            label: lang.material_requests,
            route: route('production.requests', { building_id: 1, type: 'transfer' }),
            selected: [
                route('production.requests', { building_id: 1, type: 'transfer' }),
                route('production.requests', { building_id: 2, type: 'transfer' }),
                route('production.requests', { building_id: 3, type: 'transfer' }),
                route('production.requests', { building_id: 1, type: 'phosphate' }),
                route('production.requests', { building_id: 2, type: 'shipping' }),
            ]
        },
        {
            label: lang.new_request,
            route: route('production.material-request.new'),
            selected: [
                route('production.material-request.new'),
            ]
        },
        {
            label: lang.put_away,
            route: route('production.put-away.scan'),
            selected: [
                route('production.put-away.scan'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
