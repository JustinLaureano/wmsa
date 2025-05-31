import { forwardRef } from 'react';
import { Box } from '@mui/material';
import { OverflowScrollBoxProps } from '@/types';

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
