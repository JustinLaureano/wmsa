import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function ShippingNavTabs() {
    const { lang } = useLanguage();

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
