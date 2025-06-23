import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ViewSafetyStockProps } from '@/types';
import SafetyStockNavTabs from '@/Domains/Materials/Layout/Navigation/SafetyStockNavTabs';
import { Paper } from '@mui/material';

export default function ViewSafetyStock({
    safetyStock,
    ...props
} : ViewSafetyStockProps) {

    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.safety_stock}>
            <MaterialsPageHeader />

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
                <SafetyStockNavTabs />

                stock
            </Paper>
        </SidebarLayout>
    );
}
