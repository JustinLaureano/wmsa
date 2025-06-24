import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ReceivingPageHeaderHeader from '@/Domains/Receiving/Layout/Header/ReceivingHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ViewPurchasingDocuments() {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.purchasing_documents}>
            <ReceivingPageHeaderHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
