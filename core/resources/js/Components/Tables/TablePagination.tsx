import { Link } from '@inertiajs/react';
import { PaginationItem, Pagination, Stack, Typography, useTheme } from '@mui/material';
import { TablePaginationProps } from './types';

export default function TablePagination({ pagination } : TablePaginationProps) {
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
                defaultPage={current_page}
                count={last_page}
                siblingCount={1}
                size="small"
                renderItem={(item) => {

                    let url : string = path;

                    if (item.type == 'previous') {
                        url = prev_page_url;
                    }
                    else if (item.type == 'next') {
                        url = next_page_url
                    }
                    else if (item.type == 'page') {
                        const link = links.filter(link => parseInt(link.label) == item.page)[0];
                        url = link.url || '';
                    }
                    else if (item.type == 'end-ellipsis') {
                        url = '';
                    }

                    return (
                        <PaginationItem
                            component={Link}
                            href={url}
                            {...item}
                        />
                    )
                }}
            />
        </Stack>
    )
}