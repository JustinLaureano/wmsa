import { JsonObject } from "@/types";

export interface LinkInterface {
    url?: string;
    label: string;
    active: boolean;
}

export interface Pagination {
    current_page: number;
    data: JsonObject[];
    from: number;
    last_page: number;
    prev_page_url: string;
    next_page_url: string;
    path: string;
    links: LinkInterface[];
    to: number;
    total: number;
}

export interface TablePaginationProps {
    pagination: Pagination;
    onChange: (page: number) => void;
}

export interface ColumnInterface {
    field: string;
    headerName: string;
    renderCell?: (params: RenderCellParams) => React.ReactNode;
}

export interface RenderCellParams {
    row: RowInterface;
    field: string;
    index: number;
    value: any;
}

export interface RowInterface {
    [key: string]: any
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
    onRequestSort: (event: React.MouseEvent<unknown>, property: string) => void;
}
