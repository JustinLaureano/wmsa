import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function ProductionNavTabs() {
    const { lang } = useLanguage();

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
        {
            label: lang.machines,
            route: route('machines'),
            selected: [
                route('machines'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
