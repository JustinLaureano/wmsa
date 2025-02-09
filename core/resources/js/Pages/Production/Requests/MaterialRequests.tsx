import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';

interface MaterialRequestsProps {}

export default function MaterialRequests({ ...props } : MaterialRequestsProps) {
    const { lang } = useContext(LanguageContext);

    console.log(props.requests);

    return (
        <SidebarLayout title={lang.requests}>
            <ProductionPageHeader />

        </SidebarLayout>
    );
}
