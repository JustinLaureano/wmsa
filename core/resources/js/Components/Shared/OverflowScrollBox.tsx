import { Box } from '@mui/material';
import React, { forwardRef } from 'react';

interface OverflowScrollBoxProps extends React.ComponentProps<any> {
    children: React.ReactNode;
}

export default function OverflowScrollBox({ children, ...props }: OverflowScrollBoxProps) {
    const { sx, ...rest } = props;

	return (
        <Box
            sx={{
                overflow: 'scroll',
                '::-webkit-scrollbar': {
                    display: 'none'
                },
                ...sx
            }}
            {...rest}
        >
            {children}
        </Box>
	);
}

export const RefOverflowScrollBox = forwardRef<HTMLDivElement, OverflowScrollBoxProps>((
    { children, ...props },
    ref
) => {
    const { sx, ...rest } = props;

    return (
        <Box
            ref={ref}
            sx={{
                overflow: 'scroll',
                '::-webkit-scrollbar': {
                    display: 'none'
                },
                ...sx
            }}
            {...rest}
        >
            {children}
        </Box>
    )
});
