import { useContext, useEffect, useState, useRef } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import StoreContainerHeader from '@/Domains/Production/Layout/Header/StoreContainerHeader';


export default function StoreContainer({ materialContainer }: { materialContainer: any }) {
    const { lang } = useContext(LanguageContext);

    console.log(materialContainer);

    return (
        <SidebarLayout title={lang.put_away}>
            <StoreContainerHeader />
            material container
        </SidebarLayout>
    );
}
