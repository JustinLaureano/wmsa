import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import ReceivingPageHeaderHeader from '@/Domains/Receiving/Layout/Header/ReceivingHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ViewPurchasingDocuments() {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.purchasing_documents}>
            <ReceivingPageHeaderHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
