import { StorageLocationResource, JsonPaginateCollection } from "@/types";

export interface StorageLocationDataProps {
    storageLocations: JsonPaginateCollection<StorageLocationResource>;
}
