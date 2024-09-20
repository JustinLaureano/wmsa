import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';

interface ViewSortListProps {}

export default function ViewSortList({ ...props } : ViewSortListProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <QualityPageHeader />
        </DashboardLayout>
    );
}
