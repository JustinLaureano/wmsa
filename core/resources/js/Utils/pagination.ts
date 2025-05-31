import { JsonPaginateCollectionLinks, JsonPaginateCollectionMeta } from '@/types';

export const getCollectionPagination = (
    links: JsonPaginateCollectionLinks,
    meta: JsonPaginateCollectionMeta
) => {
    return {
        current_page: meta.current_page,
        from: meta.from,
        last_page: meta.last_page,
        first_page_url: links.first,
        prev_page_url: links.prev,
        next_page_url: links.next,
        last_page_url: links.last,
        path: meta.path,
        links: links,
        to: meta.to,
        total: meta.total,
    }
}