import { JsonApiResource} from "@/types";

export interface MessageAttributes {
    [key: string]: any;
}

export interface MessageRelations {
    [key: string]: any;
}

export interface MessageComputed {
    [key: string]: any;
}

export type MessageResource = JsonApiResource<
    MessageAttributes,
    MessageRelations,
    MessageComputed
>;
