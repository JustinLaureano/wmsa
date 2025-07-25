import { JsonPaginateCollection, SafetyStockReportResource } from "@/types";

export interface ViewSafetyStockProps {
    safetyStock: JsonPaginateCollection<SafetyStockReportResource>;
}