import { ViewSortListInventoryResource } from "@/types";

export interface QuantityUpdateInputProps {
    quantity: number;
    onHandleQuantityChange: (e: React.ChangeEvent<HTMLInputElement>, container: ViewSortListInventoryResource) => void;
    onSaveQuantityChange: (container: ViewSortListInventoryResource) => void;
    container: ViewSortListInventoryResource;
}