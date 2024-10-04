import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { PartNumberSearchFilterProps } from "../types";

export default function PartNumberSearchFilter({
    onFilterChange,
    ...props
} : PartNumberSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'part_number'}
            label={'Part'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
