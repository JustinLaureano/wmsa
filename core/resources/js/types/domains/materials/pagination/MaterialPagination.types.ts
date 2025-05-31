import { Pagination } from '@/types/shared';
import { Material } from '../entities';

export interface MaterialPagination extends Pagination {
    // TODO: change to JsonApiResource<Material>[] when ready
    data: Material[];
}