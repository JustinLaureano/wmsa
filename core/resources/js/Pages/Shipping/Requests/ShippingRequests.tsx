import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ShippingPageHeader from '@/Domains/Shipping/Layout/Header/ShippingPageHeader';

export default function ShippingRequests() {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.requests}>
            <ShippingPageHeader />

        </SidebarLayout>
    );
}
