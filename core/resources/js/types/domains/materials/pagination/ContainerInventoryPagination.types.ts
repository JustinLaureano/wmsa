import { Pagination } from '@/types/shared';
import { ContainerInventory } from "../entities";

export interface ContainerInventoryPagination extends Pagination {
    // TODO: change to JsonApiResource<ContainerInventory>[] when ready
    data: ContainerInventory[];
}