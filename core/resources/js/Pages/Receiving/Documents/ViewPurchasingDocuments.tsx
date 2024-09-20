import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ReceivingPageHeaderHeader from '@/Domains/Receiving/Layout/Header/ReceivingHeader';

interface ViewPurchasingDocumentsProps {}

export default function ViewPurchasingDocuments({ ...props } : ViewPurchasingDocumentsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.requests}>
            <ReceivingPageHeaderHeader />

        </DashboardLayout>
    );
}
