import { Pagination } from '@/types/shared';

export interface TablePaginationProps {
    pagination: Pagination;
    onChange: (page: number) => void;
}