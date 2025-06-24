import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function ReceivingNavTabs() {
    const { lang } = useContext(LanguageContext);

    const tabs = [
        {
            label: lang.view_documents,
            route: route('receiving.documents'),
            selected: [
                route('receiving.documents'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
