import { Stack, Typography, useTheme } from '@mui/material';
import { Link } from '@inertiajs/react';
import ArrowBackIcon from '@mui/icons-material/ArrowBack';

export default function StoreContainerHeader() {
    const theme = useTheme();

    return (
        <Stack sx={{ mb: theme.spacing(4) }} spacing={2}>

            <Link
                href={route('production.put-away.scan')}
                style={{
                    textDecoration: 'none',
                    color: theme.palette.text.secondary,
                    display: 'flex',
                    alignItems: 'center',
                    gap: '4px'
                }}
            >
                <ArrowBackIcon sx={{ fontSize: 14 }} />
                <Typography
                    variant="body2"
                    sx={{
                        '&:hover': {
                            textDecoration: 'underline'
                        }
                    }}
                >
                    Back to Scan
                </Typography>
            </Link>

            <Typography variant="h3">Store Container</Typography>
        </Stack>
    )
}
