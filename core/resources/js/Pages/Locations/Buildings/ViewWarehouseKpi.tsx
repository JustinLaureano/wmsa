import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ViewWarehouseKpi() {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.warehouse_kpi}>
            <LocationsPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
