import { MaterialBarcodeResource } from "@/types";
import { SxProps } from "@mui/material";

export interface BarcodeLabelDialogProps {
    open: boolean;
    onClose: () => void;
    barcodeLabel: MaterialBarcodeResource | null;
}

export type InfoRowProps = {
    label: string;
    content: string | number | null;
    sx?: SxProps;
}
