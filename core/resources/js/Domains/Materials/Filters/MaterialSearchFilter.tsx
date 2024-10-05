import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { MaterialSearchFilterProps } from "../types";

export default function MaterialNumberSearchFilter({
    onFilterChange,
    ...props
} : MaterialSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'search'}
            operation={'search'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
