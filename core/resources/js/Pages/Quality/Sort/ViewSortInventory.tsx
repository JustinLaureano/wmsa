import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';
import { ViewSortInventoryProps } from '@/types';
import { Paper } from '@mui/material';
import SortInventoryNavTabs from '@/Domains/Quality/Layout/Navigation/SortInventoryNavTabs';
export default function ViewSortInventory({ inventory }: ViewSortInventoryProps) {
    const { lang } = useContext(LanguageContext);
    console.log(inventory);
    return (
        <SidebarLayout title={lang.inventory}>
            <QualityPageHeader />

            <Paper variant="outlined" sx={{ maxWidth: '1100px', width: '90vw', margin: '0 auto', p: 5 }}>
                <SortInventoryNavTabs />
            </Paper>
        </SidebarLayout>
    );
}
