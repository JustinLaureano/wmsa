export interface JsonApiCollection<TData, TComputed = Record<string, any>, TMeta = Record<string, any>> {
    data: TData[];
    computed: TComputed;
    meta: TMeta;
}