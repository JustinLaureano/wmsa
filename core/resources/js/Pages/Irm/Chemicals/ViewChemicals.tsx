import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import IrmPageHeader from '@/Domains/Irm/Layout/Header/IrmPageHeader';

interface ViewChemicalsProps {}

export default function ViewChemicals({ ...props } : ViewChemicalsProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <DashboardLayout title={lang.inventory}>
            <IrmPageHeader />
        </DashboardLayout>
    );
}
