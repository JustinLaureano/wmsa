import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ShippingPageHeader from '@/Domains/Shipping/Layout/Header/ShippingPageHeader';

interface ShippingRequestsProps {}

export default function ShippingRequests({ ...props } : ShippingRequestsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.requests}>
            <ShippingPageHeader />

        </DashboardLayout>
    );
}
