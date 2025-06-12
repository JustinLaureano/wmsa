import { StorageLocationResource, JsonPaginateCollection } from "@/types";

export interface StorageLocationDataTableProps {
    storageLocations: JsonPaginateCollection<StorageLocationResource>;
}
