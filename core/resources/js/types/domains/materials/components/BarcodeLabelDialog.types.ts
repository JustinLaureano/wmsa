import { MaterialBarcodeResource } from "@/types";

export interface BarcodeLabelDialogProps {
    open: boolean;
    onClose: () => void;
    barcodeLabel: MaterialBarcodeResource | null;
}
