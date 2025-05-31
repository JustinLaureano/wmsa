import { Pagination } from '@/types/shared';
import { MaterialInventoryCollection } from '../resources';

export interface MaterialInventoryPagination extends Pagination {
    data: MaterialInventoryCollection[];
}