import { Box } from '@mui/material';
import React, { forwardRef } from 'react';

interface OverflowScrollBoxProps extends React.ComponentProps<any> {
    children: React.ReactNode;
}

export default function OverflowScrollBox({ children, ...props }: OverflowScrollBoxProps) {
	return (
        <Box
            sx={{
                overflow: 'scroll',
                '::-webkit-scrollbar': {
                    display: 'none'
                }
            }}
            {...props}
        >
            {children}
        </Box>
	);
}

export const RefOverflowScrollBox = forwardRef<HTMLDivElement, OverflowScrollBoxProps>((
    { children, ...props },
    ref
) => (
    <Box
        ref={ref}
        sx={{
            overflow: 'scroll',
            '::-webkit-scrollbar': {
                display: 'none'
            }
        }}
        {...props}
    >
        {children}
    </Box>
));
