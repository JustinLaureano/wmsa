import { JsonApiCollection } from "./JsonApiCollection.types";

export interface JsonPaginateCollectionLinks {
    first: string;
    last: string;
    next: string;
    prev: string;
}

export interface JsonPaginateCollectionMeta {
    current_page: number;
    from: number;
    last_page: number;
    links: {
        url: string;
        label: string;
        active: boolean;
    }[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

export interface JsonPaginateCollection<TResource> {
    data: JsonApiCollection<TResource>;
    links: JsonPaginateCollectionLinks;
    meta: JsonPaginateCollectionMeta;
}