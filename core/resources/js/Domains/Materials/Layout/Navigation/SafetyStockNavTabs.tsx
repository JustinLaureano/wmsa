import { NavigationTab, JsonObject } from '@/types';
import SubpageNavigationTabs from '@/Components/Navigation/SubpageNavigationTabs';
import { useLanguage } from '@/Providers/LanguageProvider';

const tabs = (lang: JsonObject) : NavigationTab[] => {
    return [
        {
            label: lang.all,
            route: route('materials.safety-stock'),
            selected: [
                route('materials.safety-stock'),
            ]
        },
        {
            label: lang.comp,
            route: route('materials.safety-stock', { material_type_code: 'COMP' }),
            selected: [
                route('materials.safety-stock', { material_type_code: 'COMP' }),
            ]
        },
        {
            label: lang.cmet,
            route: route('materials.safety-stock', { material_type_code: 'CMET' }),
            selected: [
                route('materials.safety-stock', { material_type_code: 'CMET' }),
            ]
        },
        {
            label: lang.irm,
            route: route('materials.safety-stock', { material_type_code: 'IRM' }),
            selected: [
                route('materials.safety-stock', { material_type_code: 'IRM' }),
            ]
        },
    ]
}

export default function SafetyStockNavTabs() {
    const { lang } = useLanguage();

    return (
        <SubpageNavigationTabs
            tabs={tabs(lang)}
            centered
            sx={{ mb: 4 }}
        />
    )
}
