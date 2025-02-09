import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ReceivingPageHeaderHeader from '@/Domains/Receiving/Layout/Header/ReceivingHeader';

interface ViewPurchasingDocumentsProps {}

export default function ViewPurchasingDocuments({ ...props } : ViewPurchasingDocumentsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.requests}>
            <ReceivingPageHeaderHeader />

        </SidebarLayout>
    );
}
