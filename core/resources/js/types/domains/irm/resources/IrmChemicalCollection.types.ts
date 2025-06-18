import { IrmChemicalResource } from '@/types';

export interface IrmChemicalCollection {
    data: IrmChemicalResource[];
    computed: {
        count: number;
    };
    meta: {
        timestamp: string;
    };
}