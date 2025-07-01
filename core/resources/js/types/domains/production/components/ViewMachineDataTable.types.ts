import { JsonApiCollection, JsonPaginateCollection, ViewMachineResource } from "@/types";

export interface ViewMachineDataTableProps {
    machines: JsonPaginateCollection<ViewMachineResource>;
}