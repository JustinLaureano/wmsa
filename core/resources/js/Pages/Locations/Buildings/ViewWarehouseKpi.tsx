import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';

interface ViewWarehouseKpiProps {}

export default function ViewWarehouseKpi({ ...props } : ViewWarehouseKpiProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <LocationsPageHeader />
        </DashboardLayout>
    );
}
