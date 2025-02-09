import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';

interface ViewWarehouseKpiProps {}

export default function ViewWarehouseKpi({ ...props } : ViewWarehouseKpiProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <LocationsPageHeader />
        </SidebarLayout>
    );
}
