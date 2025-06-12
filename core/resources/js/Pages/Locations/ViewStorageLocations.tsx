import { useContext } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';
import { ViewStorageLocationsProps } from '@/types';
import StorageLocationDataTable from '@/Domains/Locations/Cards/StorageLocationDataTable';

export default function ViewStorageLocations({
    storageLocations,
    ...props
} : ViewStorageLocationsProps) {
    const { lang } = useContext(LanguageContext);

    console.log(storageLocations);

    return (
        <SidebarLayout title={lang.storage_locations}>
            <LocationsPageHeader />

            <StorageLocationDataTable
                storageLocations={storageLocations}
            />
        </SidebarLayout>
    );
}
