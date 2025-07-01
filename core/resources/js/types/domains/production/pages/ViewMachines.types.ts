import { JsonPaginateCollection, ViewMachineResource } from "@/types";

export interface ViewMachinesProps {
    machines: JsonPaginateCollection<ViewMachineResource>;
}