import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import ShippingPageHeader from '@/Domains/Shipping/Layout/Header/ShippingPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ShippingRequests() {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={`${lang.shipping} ${lang.requests}`}>
            <ShippingPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
