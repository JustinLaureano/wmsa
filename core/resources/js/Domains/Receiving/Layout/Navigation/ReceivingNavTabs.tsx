import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function ReceivingNavTabs() {
    const { lang } = useLanguage();

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
