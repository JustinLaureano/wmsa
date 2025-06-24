import { useContext } from "react";
import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";

export default function PartNumberSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <TextSearchFilter
            field={'part_number'}
            label={lang.part}
            onFilterChange={onFilterChange}
            placeholder={`${lang.part}...`}
            {...props}
        />
    )
}
