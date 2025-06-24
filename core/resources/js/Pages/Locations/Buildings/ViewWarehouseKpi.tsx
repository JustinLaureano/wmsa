import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ViewWarehouseKpi() {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.warehouse_kpi}>
            <LocationsPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
