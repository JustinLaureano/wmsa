import { MaterialInventoryResource } from './MaterialInventoryResource.types';

export interface MaterialInventoryCollection {
    data: MaterialInventoryResource[];
    computed: {
        count: number;
    };
    meta: {
        timestamp: string;
    };
}