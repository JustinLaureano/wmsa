import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import { useLanguage } from "@/Providers/LanguageProvider";

export default function IrmChemicalSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useLanguage();

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
