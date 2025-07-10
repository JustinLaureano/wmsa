import { ViewSortLocationInventoryResource } from "@/types";

export interface QuantityUpdateInputProps {
    quantity: number;
    onHandleQuantityChange: (e: React.ChangeEvent<HTMLInputElement>, container: ViewSortLocationInventoryResource) => void;
    onSaveQuantityChange: (container: ViewSortLocationInventoryResource) => void;
    container: ViewSortLocationInventoryResource;
}