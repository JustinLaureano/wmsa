import { Pagination } from '@/types/shared';
import { ViewMachineResource } from '../resources';

export interface ViewMachinePagination extends Pagination {
    data: ViewMachineResource[];
}