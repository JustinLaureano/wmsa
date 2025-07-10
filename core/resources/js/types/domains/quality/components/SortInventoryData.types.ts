import {
    JsonPaginateCollection,
    MaterialAutocompleteResource,
    ViewSortLocationInventoryResource
} from "@/types";

export interface SortInventoryDataProps {
    inventory: JsonPaginateCollection<ViewSortLocationInventoryResource>;
    materialOptions: MaterialAutocompleteResource[];
}