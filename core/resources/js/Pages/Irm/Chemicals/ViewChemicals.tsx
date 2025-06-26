import { ViewChemicalsProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import IrmPageHeader from '@/Domains/Irm/Layout/Header/IrmPageHeader';
import ViewIrmChemicalDataTable from '@/Domains/Irm/Cards/ViewIrmChemicalDataTable';

export default function ViewChemicals({ chemicals } : ViewChemicalsProps) {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.irm}>
            <IrmPageHeader />

            <ViewIrmChemicalDataTable
                chemicals={chemicals}
            />
        </SidebarLayout>
    );
}
