import {
    Divider,
    Paper,
    Stack,
    Typography,
} from "@mui/material";
import { UserInfoCardProps } from "@/types";

export default function UserInfoCard({ icon, title, children }: UserInfoCardProps) {
    return (
        <Paper
            elevation={1}
            sx={{
                p: 3,
                height: '100%',
            }}
        >
            <Stack
                direction="row"
                spacing={2}
                sx={{
                    width: '100%',
                    mb: 2,
                }}
            >
                {icon}
                <Typography
                    variant="h6"
                    color="text.primary"
                    gutterBottom
                >
                    {title}
                </Typography>
            </Stack>

            <Divider />

            <Stack
                spacing={2}
                sx={{
                    mt: 2,
                    height: '100%',
                }}
            >
                {children}
            </Stack>
        </Paper>
    )
}