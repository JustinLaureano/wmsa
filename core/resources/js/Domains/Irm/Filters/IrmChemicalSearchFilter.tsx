import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";

export default function IrmChemicalSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'search'}
            operation={'search'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
