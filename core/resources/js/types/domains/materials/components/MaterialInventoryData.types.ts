import { MaterialInventoryResource } from "../resources";
import { JsonPaginateCollection } from "@/types/shared";

export interface MaterialInventoryDataProps {
    inventory: JsonPaginateCollection<MaterialInventoryResource>;
}