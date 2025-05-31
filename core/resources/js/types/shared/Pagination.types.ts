import { JsonApiCollection } from "./JsonApiCollection.types";
import { JsonApiResource } from "./JsonApiResource.types";
import { PaginationLink } from "./PaginationLink.types";
import { JsonObject } from "./JsonObject.types";

export interface Pagination {
    current_page: number;
    // TODO: change to only allow JsonApiResource<any>[] or JsonApiCollection<any>[] when ready
    data: JsonApiResource<any>[] | JsonApiCollection<any>[] | JsonObject | Record<string, any>;
    from: number;
    last_page: number;
    prev_page_url: string;
    next_page_url: string;
    path: string;
    links: PaginationLink[];
    to: number;
    total: number;
}