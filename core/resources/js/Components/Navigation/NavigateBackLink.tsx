import { Link } from '@inertiajs/react';
import { Typography, useTheme } from '@mui/material';
import ArrowBackIcon from '@mui/icons-material/ArrowBack';
import { NavigateBackLinkProps } from '@/types';

export default function NavigateBackLink({
    route,
    label
}: NavigateBackLinkProps) {
    const theme = useTheme();

    return (
        <Link
            href={route}
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
                {label}
            </Typography>
        </Link>
    )
}