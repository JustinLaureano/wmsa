import { CollectionPagination } from '../../shared/CollectionPagination.types';

export interface CollectionPaginationProps {
    pagination: CollectionPagination;
    onChange: (page: number) => void;
}