import { MaterialRequestItemListResource } from "./MaterialRequestListItemResource.types";

export interface MaterialRequestListResource {
    uuid: string;
    title: string;
    requester_name: string;
    requested_at: string;
    status: string;
    type: string;
    items: MaterialRequestItemListResource[];
}