import { JsonPaginateCollection, SafetyStockReportResource } from "@/types";

export interface SafetyStockReportDataProps {
    safetyStock: JsonPaginateCollection<SafetyStockReportResource>;
}