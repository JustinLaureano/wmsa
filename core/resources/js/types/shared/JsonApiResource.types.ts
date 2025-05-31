export interface JsonApiResource<TAttributes, TRelations = Record<string, any>, TComputed = Record<string, any>> {
    uuid: string;
    attributes: TAttributes;
    relations?: TRelations;
    computed?: TComputed;
}