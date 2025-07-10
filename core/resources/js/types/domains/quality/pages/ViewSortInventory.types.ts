import {
    JsonPaginateCollection,
    MaterialAutocompleteResource,
    ViewSortLocationInventoryResource
} from "@/types";

export interface ViewSortInventoryProps {
    inventory: JsonPaginateCollection<ViewSortLocationInventoryResource>;
    materialOptions: MaterialAutocompleteResource[];
}