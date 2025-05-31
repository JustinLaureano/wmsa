import { ReactNode } from 'react';
import { Box } from '@mui/material';

export default function StyledTabsContainer({ children, ...props } : { children: ReactNode }) {
    return (
        <Box sx={{ borderBottom: 1, borderColor: 'divider' }}>
            {children}
        </Box>
    )
}
