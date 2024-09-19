import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import PageHeader from '@/Domains/Production/Layout/Header/PageHeader';

interface CreateRequestProps {}

export default function CreateRequest({ ...props } : CreateRequestProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.requests}>
            <PageHeader />

        </DashboardLayout>
    );
}
