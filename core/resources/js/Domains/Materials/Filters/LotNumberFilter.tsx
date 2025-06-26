import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import { useLanguage } from "@/Providers/LanguageProvider";

export default function LotNumberFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useLanguage();

    return (
        <TextSearchFilter
            field={'lot_number'}
            label={lang.lot}
            onFilterChange={onFilterChange}
            placeholder={`${lang.lot}...`}
            {...props}
        />
    )
}
