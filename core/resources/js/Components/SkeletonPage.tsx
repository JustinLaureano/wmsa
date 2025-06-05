import { Box, Stack, Skeleton } from '@mui/material';

export default function SkeletonPage() {
    return (
        <Box
            sx={{
                width: '90%',
                mx: 'auto',
                maxWidth: 1200,
            }}
        >
            <Stack direction="row" spacing={2}>
                <Skeleton variant="rectangular" width="33%" height={200} />
                <Skeleton variant="rectangular" width="33%" height={200} />
                <Skeleton variant="rectangular" width="33%" height={200} />
            </Stack>

            <Stack direction="row" spacing={2} sx={{ mt: 4 }}>
                <Skeleton variant="rectangular" width="50%" height={300} />
                <Skeleton variant="rectangular" width="50%" height={300} />
            </Stack>

            <Box sx={{ mt: 4 }}>
                <Skeleton variant="rectangular" height={300} />
            </Box>
        </Box>
    );
}
