import { useContext } from 'react';
import { ViewChemicalsProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import IrmPageHeader from '@/Domains/Irm/Layout/Header/IrmPageHeader';
import ViewIrmChemicalDataTable from '@/Domains/Irm/Cards/ViewIrmChemicalDataTable';

export default function ViewChemicals({ chemicals } : ViewChemicalsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.irm}>
            <IrmPageHeader />

            <ViewIrmChemicalDataTable
                chemicals={chemicals}
            />
        </SidebarLayout>
    );
}
