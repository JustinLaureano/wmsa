import { CircularProgress, Stack } from "@mui/material";

export default function LoadingIndicator({ isLoading }: { isLoading: boolean }) {
    return (
        <Stack
            justifyContent="center"
            sx={{
                minHeight: 28,
                padding: 1,
            }}
        >
            {
                isLoading &&
                <CircularProgress
                    size={14}
                    sx={{
                        color: 'text.secondary',
                    }}
                />
            }
        </Stack>
    );
}