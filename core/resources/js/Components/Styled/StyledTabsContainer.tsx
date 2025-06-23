import { ReactNode } from 'react';
import { Box, SxProps } from '@mui/material';

export default function StyledTabsContainer({ children, sx = {} } : { children: ReactNode, sx?: SxProps }) {
    return (
        <Box sx={{ borderBottom: 1, borderColor: 'divider', ...sx }}>
            {children}
        </Box>
    )
}
