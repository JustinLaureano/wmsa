import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";

export default function LotNumberFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'lot_number'}
            label={'Lot Number'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
