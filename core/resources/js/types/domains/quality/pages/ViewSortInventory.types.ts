import {
    JsonPaginateCollection,
    MaterialAutocompleteResource,
    ViewSortListInventoryResource
} from "@/types";

export interface ViewSortInventoryProps {
    inventory: JsonPaginateCollection<ViewSortListInventoryResource>;
    materialOptions: MaterialAutocompleteResource[];
}