import {
    CollectionPagination,
    JsonApiCollection,
    JsonPaginateCollectionLinks,
    JsonPaginateCollectionMeta
} from '@/types';

export const getCollectionPagination = (
    links: JsonPaginateCollectionLinks,
    meta: JsonPaginateCollectionMeta
) => {
    const pagination: CollectionPagination = {
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

    return pagination;
}

/**
 * This will input a collection pagination object and return a pagination object with the data.
 *
 * @param data
 * @returns 
 */
export const collectionPaginationToPagination = (data: any) => {
    return {
        ...getCollectionPagination(data.links, data.meta),
        data: data.data
    }
}