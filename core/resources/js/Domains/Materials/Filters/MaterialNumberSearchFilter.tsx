import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";

export default function MaterialNumberSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'material_number'}
            label={'Material'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
