/**
 * Represents a JSON-compatible value: string, number, boolean, null, array, or nested object
 */
type JsonValue =
    | string
    | number
    | boolean
    | null
    | JsonValue[]
    | JsonObject;

/**
 * Represents a JSON-like object with string keys and JSON-compatible values
 */
export interface JsonObject {
    [key: string]: any;
}