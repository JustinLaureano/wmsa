import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';
import { ViewSortInventoryProps } from '@/types';

export default function ViewSortInventory({ inventory }: ViewSortInventoryProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <QualityPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
