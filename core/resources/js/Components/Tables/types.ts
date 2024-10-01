export interface LinkInterface {
    url?: string;
    label: string;
    active: boolean;
}

export interface Pagination {
    current_page: number;
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
}

export interface ColumnInterface {
    field: string;
    headerName: string;
}

export interface RowInterface {
    [key: string]: any
}

export interface DataTableProps {
    columns: ColumnInterface[];
    rows: RowInterface[];
    dense?: boolean;
    pagination: Pagination;
    onFilterEvent: () => void;
}

export interface DataTableHeaderCellProps {
    column: ColumnInterface;
    active: boolean;
    direction: 'asc' | 'desc';
    onRequestSort: (event: React.MouseEvent<unknown>, property: string) => void;
}