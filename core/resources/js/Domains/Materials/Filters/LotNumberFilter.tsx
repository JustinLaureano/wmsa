import { useContext } from "react";
import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";

export default function LotNumberFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useContext(LanguageContext);

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
