import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';

export default function ViewSortList() {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <QualityPageHeader />
        </SidebarLayout>
    );
}
