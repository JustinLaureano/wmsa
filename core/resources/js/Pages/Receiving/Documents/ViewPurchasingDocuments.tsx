import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ReceivingPageHeaderHeader from '@/Domains/Receiving/Layout/Header/ReceivingHeader';

export default function ViewPurchasingDocuments() {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.requests}>
            <ReceivingPageHeaderHeader />

        </SidebarLayout>
    );
}
