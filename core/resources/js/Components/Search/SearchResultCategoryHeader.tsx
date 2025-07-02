import { Typography } from "@mui/material";

export default function SearchResultCategoryHeader({ title }: { title: string }) {
    return (
        <Typography variant="h6">
            {title}
        </Typography>
    );
}