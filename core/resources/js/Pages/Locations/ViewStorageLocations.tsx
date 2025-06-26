import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import LocationsPageHeader from '@/Domains/Locations/Layout/Header/LocationsPageHeader';
import { ViewStorageLocationsProps } from '@/types';
import StorageLocationData from '@/Domains/Locations/Cards/StorageLocationData';

export default function ViewStorageLocations({
    storageLocations,
    ...props
} : ViewStorageLocationsProps) {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.storage_locations}>
            <LocationsPageHeader />

            <StorageLocationData
                storageLocations={storageLocations}
            />
        </SidebarLayout>
    );
}
