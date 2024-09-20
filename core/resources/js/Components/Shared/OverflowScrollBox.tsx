import { Box } from '@mui/material';

interface OverflowScrollBoxProps {
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
