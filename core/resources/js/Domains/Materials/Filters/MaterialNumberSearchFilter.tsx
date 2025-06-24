import { useContext } from "react";
import TextSearchFilter from "@/Components/Tables/Filters/TextSearchFilter";
import { TextSearchFilterProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";

export default function MaterialNumberSearchFilter({
    onFilterChange,
    ...props
} : TextSearchFilterProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <TextSearchFilter
            field={'material_number'}
            label={lang.material}
            onFilterChange={onFilterChange}
            placeholder={`${lang.material}...`}
            {...props}
        />
    )
}
