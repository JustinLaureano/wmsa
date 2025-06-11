import {
    JsonPaginateCollection,
    MaterialAutocompleteResource,
    ViewSortListInventoryResource
} from "@/types";

export interface SortInventoryDataProps {
    inventory: JsonPaginateCollection<ViewSortListInventoryResource>;
    materialOptions: MaterialAutocompleteResource[];
}