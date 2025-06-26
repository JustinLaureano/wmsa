import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import MaterialsPageHeader from '@/Domains/Materials/Layout/Header/MaterialsPageHeader';
import { ViewSafetyStockProps } from '@/types';
import SafetyStockNavTabs from '@/Domains/Materials/Layout/Navigation/SafetyStockNavTabs';
import { Paper } from '@mui/material';
import SafetyStockReportData from '@/Domains/Materials/Cards/SafetyStockReport/SafetyStockReportData';

export default function ViewSafetyStock({
    safetyStock,
    ...props
} : ViewSafetyStockProps) {

    const { lang } = useLanguage();
    return (
        <SidebarLayout title={lang.safety_stock}>
            <MaterialsPageHeader />

            <Paper
                variant="outlined"
                sx={{
                    maxWidth: '1400px',
                    width: '90vw',
                    margin: '0 auto',
                    px: 5,
                    mb: 4
                }}
            >
                <SafetyStockNavTabs />

                <SafetyStockReportData safetyStock={safetyStock} />
            </Paper>
        </SidebarLayout>
    );
}
