import { MaterialInventoryResource, MaterialAutocompleteResource } from "../resources";
import { JsonPaginateCollection } from "@/types/shared";

export interface ShowMaterialInventoryProps {
    inventory: JsonPaginateCollection<MaterialInventoryResource>;
    materialOptions: MaterialAutocompleteResource[];
}
