import React from 'react';
import { Box } from '@mui/material';

interface StyledTabsContainerProps {
    children: React.ReactNode;
}

export default function StyledTabsContainer({ children, ...props } : StyledTabsContainerProps) {
    return (
        <Box sx={{ borderBottom: 1, borderColor: 'divider' }}>
            {children}
        </Box>
    )
}
