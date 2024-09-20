import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';

interface CreateRequestProps {}

export default function CreateRequest({ ...props } : CreateRequestProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.requests}>
            <ProductionPageHeader />

        </DashboardLayout>
    );
}
