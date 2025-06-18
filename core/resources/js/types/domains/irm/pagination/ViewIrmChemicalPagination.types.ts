import { Pagination } from '@/types/shared';
import { ViewIrmChemicalResource } from '../resources';

export interface ViewIrmChemicalPagination extends Pagination {
    data: ViewIrmChemicalResource[];
}