import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ShippingPageHeader from '@/Domains/Shipping/Layout/Header/ShippingPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ShippingRequests() {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={`${lang.shipping} ${lang.requests}`}>
            <ShippingPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
