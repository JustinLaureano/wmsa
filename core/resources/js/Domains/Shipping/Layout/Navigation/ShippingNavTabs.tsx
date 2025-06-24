import { useContext } from 'react';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import LanguageContext from '@/Contexts/LanguageContext';

export default function ShippingNavTabs() {
    const { lang } = useContext(LanguageContext);

    const tabs = [
        {
            label: `${lang.shipping} ${lang.requests}`,
            route: route('shipping.requests'),
            selected: [
                route('shipping.requests'),
            ]
        },
    ]

    return (
        <SubpageNavigationTabs
            tabs={tabs}
        />
    )
}
