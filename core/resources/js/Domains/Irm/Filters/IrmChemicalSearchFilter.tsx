import { useContext } from "react";
import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";

export default function IrmChemicalSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <TextSearchFilter
            field={'search'}
            operation={'search'}
            onFilterChange={onFilterChange}
            placeholder={`${lang.search}...`}
            {...props}
        />
    )
}
