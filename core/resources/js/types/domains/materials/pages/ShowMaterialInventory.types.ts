import { MaterialInventoryResource, MaterialOptionResource } from "../resources";
import { JsonPaginateCollection } from "@/types/shared";

export interface ShowMaterialInventoryProps {
    inventory: JsonPaginateCollection<MaterialInventoryResource>;
    materialOptions: MaterialOptionResource[];
}
