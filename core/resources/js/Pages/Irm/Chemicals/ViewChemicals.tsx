import { useContext } from 'react';
import { ViewChemicalsProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import IrmPageHeader from '@/Domains/Irm/Layout/Header/IrmPageHeader';

export default function ViewChemicals({ ...props } : ViewChemicalsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.inventory}>
            <IrmPageHeader />
        </SidebarLayout>
    );
}
