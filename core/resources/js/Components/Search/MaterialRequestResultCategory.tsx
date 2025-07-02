import { useLanguage } from "@/Providers/LanguageProvider";
import { SearchResultCategoryProps } from "@/types";
import SearchResultCategoryHeader from "./SearchResultCategoryHeader";
import { Box, List } from "@mui/material";
import SearchResultItem from "./SearchResultItem";
import { toLocalTime } from "@/Utils/date";

export default function MaterialRequestResultCategory({ title, results }: SearchResultCategoryProps) {
    const { lang } = useLanguage();

    return (
        <Box sx={{ py: 2, px: 3 }}>
            <SearchResultCategoryHeader title={title} />
            <List>
                {results.map((result) => (
                    <SearchResultItem
                        key={`${result.type}_${result.key}`}
                        primaryText={result.primary_text}
                        secondaryText={toLocalTime(result.requested_at, 'MM/dd/yyyy hh:mm a')}
                        url={result.url}
                    />
                ))}
            </List>
        </Box>
    );
}