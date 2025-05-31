import { ReactNode, MouseEvent } from 'react';
import { JsonObject, Pagination } from '@/types/shared';

export interface RowInterface {
    [key: string]: any;
}

export interface RenderCellParams {
    row: RowInterface;
    field: string;
    index: number;
    value: any;
}

export interface ColumnInterface {
    field: string;
    headerName: string;
    renderCell?: (params: RenderCellParams) => ReactNode;
}

export interface DataTableProps {
    columns: ColumnInterface[];
    rows: RowInterface[];
    dense?: boolean;
    pagination: Pagination;
    filters: any[];
    onFilterEvent: (filterParams: JsonObject) => void;
}

export interface DataTableHeaderCellProps {
    column: ColumnInterface;
    active: boolean;
    direction: 'asc' | 'desc';
    onRequestSort: (event: MouseEvent<unknown>, property: string) => void;
}