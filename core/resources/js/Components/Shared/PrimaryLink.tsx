import { Link } from '@inertiajs/react';
import { Typography } from '@mui/material';
import { PrimaryLinkProps } from '@/types';

export default function PrimaryLink({ route, label, variant = 'body2' }: PrimaryLinkProps) {
    return (
        <Link href={route}>
            <Typography
                variant={variant}
                color="primary"
                sx={{
                    fontWeight: '500',
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
