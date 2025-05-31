export interface JsonApiCollection<TData = Record<string, any>, TComputed = Record<string, any>, TMeta = Record<string, any>> {
    data: TData[];
    computed: TComputed;
    meta: TMeta;
}