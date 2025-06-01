import { Pagination } from '../../shared/Pagination.types';

export interface TablePaginationProps {
    pagination: Pagination;
    onChange: (page: number) => void;
}