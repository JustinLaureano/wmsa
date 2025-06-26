import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function IrmNavTabs() {
    const { lang } = useLanguage();

    const tabs = [
        {
            label: lang.inventory,
            route: route('irm.chemicals.inventory'),
            selected: [
                route('irm.chemicals.inventory'),
            ]
        },
        {
            label: lang.view_chemicals,
            route: route('irm.chemicals'),
            selected: [
                route('irm.chemicals'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
