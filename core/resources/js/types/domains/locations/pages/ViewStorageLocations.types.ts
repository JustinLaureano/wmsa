import { StorageLocationResource, JsonPaginateCollection } from "@/types";

export interface ViewStorageLocationsProps {
    storageLocations: JsonPaginateCollection<StorageLocationResource>;
}
