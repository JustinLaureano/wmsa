import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import { useLanguage } from "@/Providers/LanguageProvider";

export default function PartNumberSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useLanguage();

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
