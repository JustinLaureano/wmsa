import { MaterialInventoryResource, MaterialAutocompleteResource } from "../resources";
import { JsonPaginateCollection } from "@/types/shared";

export interface MaterialInventoryDataProps {
    inventory: JsonPaginateCollection<MaterialInventoryResource>;
    materialOptions: MaterialAutocompleteResource[];
}