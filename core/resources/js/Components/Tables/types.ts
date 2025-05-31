// moved
export interface LinkInterface {
    url?: string;
    label: string;
    active: boolean;
}

// moved
export interface Pagination {
    current_page: number;
    data: Record<string, any>[];
    from: number;
    last_page: number;
    prev_page_url: string;
    next_page_url: string;
    path: string;
    links: LinkInterface[];
    to: number;
    total: number;
}

// moved
export interface TablePaginationProps {
    pagination: Pagination;
    onChange: (page: number) => void;
}

// moved
export interface ColumnInterface {
    field: string;
    headerName: string;
    renderCell?: (params: RenderCellParams) => React.ReactNode;
}

// moved
export interface RenderCellParams {
    row: RowInterface;
    field: string;
    index: number;
    value: any;
}

// moved
export interface RowInterface {
    [key: string]: any
}

// moved
export interface DataTableProps {
    columns: ColumnInterface[];
    rows: RowInterface[];
    dense?: boolean;
    pagination: Pagination;
    filters: any[];
    onFilterEvent: (filterParams: Record<string, any>) => void;
}

// moved
export interface DataTableHeaderCellProps {
    column: ColumnInterface;
    active: boolean;
    direction: 'asc' | 'desc';
    onRequestSort: (event: React.MouseEvent<unknown>, property: string) => void;
}
