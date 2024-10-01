import { TableCell, TableSortLabel } from '@mui/material';
import { DataTableHeaderCellProps } from './types';

export default function DataTableHeaderCell({
    column,
    active,
    direction,
    onRequestSort
} : DataTableHeaderCellProps) {

    const createSortHandler = (property: string) => (event: React.MouseEvent<unknown>) => {
        onRequestSort(event, property);
    };

    return (
        <TableCell
            sortDirection={active ? direction : false}
        >
            <TableSortLabel
                active={active}
                direction={direction}
                onClick={createSortHandler(column.field)}
            >
                {column.headerName}
            </TableSortLabel>
        </TableCell>
    )
}