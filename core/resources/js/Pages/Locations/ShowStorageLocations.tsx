import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';
import SkeletonPage from '@/Components/SkeletonPage';
import { ShowStorageLocationsProps } from '@/types';

export default function ShowStorageLocations({
    storageLocations,
    ...props
} : ShowStorageLocationsProps) {
    const { lang } = useContext(LanguageContext);

    console.log(storageLocations);

    return (
        <SidebarLayout title={lang.storage_locations}>
            <LocationsPageHeader />

            <SkeletonPage />
        </SidebarLayout>
    );
}
