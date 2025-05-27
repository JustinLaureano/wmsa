import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { LotNumberFilterProps } from "../types";

export default function LotNumberFilter({
    onFilterChange,
    ...props
} : LotNumberFilterProps) {

    return (
        <TextSearchFilter
            field={'lot_number'}
            label={'Lot Number'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
