import { MaterialBarcodeResource } from "./MaterialBarcodeResource.types";
import { MaterialContainerResource } from "./MaterialContainerResource.types";

export interface BarcodeInformationResource {
    barcode: MaterialBarcodeResource;
    container: MaterialContainerResource;
    type: string;
}
