export interface CollectionPagination {
    current_page: number;
    from: number;
    last_page: number;
    first_page_url: string;
    prev_page_url: string;
    next_page_url: string;
    last_page_url: string;
    path: string;
    links: {
        url: string;
        label: string;
        active: boolean;
    }[];
    to: number;
    total: number;
}
