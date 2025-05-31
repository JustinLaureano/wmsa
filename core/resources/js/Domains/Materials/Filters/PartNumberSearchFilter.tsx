import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";

export default function PartNumberSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {

    return (
        <TextSearchFilter
            field={'part_number'}
            label={'Part'}
            onFilterChange={onFilterChange}
            {...props}
        />
    )
}
