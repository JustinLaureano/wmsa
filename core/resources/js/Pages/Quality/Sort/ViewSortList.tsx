import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';

export default function ViewSortList() {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.sort_list}>
            <QualityPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
