import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';
import { ViewSortInventoryProps } from '@/types';
import { Paper } from '@mui/material';
import SortInventoryNavTabs from '@/Domains/Quality/Layout/Navigation/SortInventoryNavTabs';
import SortInventoryData from '@/Domains/Quality/Cards/SortInventory/SortInventoryData';

export default function ViewSortInventory({ inventory, materialOptions }: ViewSortInventoryProps) {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.sort_inventory}>
            <QualityPageHeader />

            <Paper
                variant="outlined"
                sx={{
                    maxWidth: '1100px',
                    width: '90vw',
                    margin: '0 auto',
                    px: 5,
                    mb: 4
                }}
            >
                <SortInventoryNavTabs />

                <SortInventoryData
                    inventory={inventory}
                    materialOptions={materialOptions}
                />
            </Paper>
        </SidebarLayout>
    );
}
