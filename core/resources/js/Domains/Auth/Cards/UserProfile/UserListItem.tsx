import {
    Box,
    Typography,
} from "@mui/material";
import { UserListItemProps } from "@/types";

export default function UserListItem({ label, value }: UserListItemProps) {
    return (
        <Box>
            <Typography
                variant="body2"
                color="text.secondary"
                gutterBottom
            >
                {label}
            </Typography>
            <Typography
                variant="body1"
            >
                {value}
            </Typography>
        </Box>
    )
}