import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function IrmNavTabs() {
    const { lang } = useContext(LanguageContext);

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
