import { Pagination, Stack, Typography, useTheme } from '@mui/material';
import { TablePaginationProps } from './types';

export default function TablePagination({ pagination, onChange } : TablePaginationProps) {
    const theme = useTheme();

    const {
        current_page,
        from,
        last_page,
        prev_page_url,
        next_page_url,
        path,
        links,
        to,
        total
    } = pagination;

    const handlePageChange = (event: React.ChangeEvent<unknown>, value: number) => {
        onChange(value)
    }

    return (
        <Stack
            direction="row"
            justifyContent="flex-end"
            alignItems="center"
            sx={{ p: 1 }}
            gap={2}
        >
            <Typography variant="body2">
                {from}-{to} of {total}
            </Typography>

            <Pagination
                page={current_page}
                defaultPage={current_page}
                count={last_page}
                siblingCount={1}
                size="small"
                onChange={handlePageChange}
            />
        </Stack>
    )
}