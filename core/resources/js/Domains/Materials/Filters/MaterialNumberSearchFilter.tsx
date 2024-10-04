import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { MaterialNumberSearchFilterProps } from "../types";

export default function MaterialNumberSearchFilter({
    onFilterChange,
    ...props
} : MaterialNumberSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'material_number'}
            label={'Material'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
