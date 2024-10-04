import {
    Box,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow
} from "@mui/material";
import { DataTableProps } from "./types";
import TablePagination from "./TablePagination";
import DataTableHeaderCell from "./DataTableHeaderCell";
import DataTableFilters from "./Filters/DataTableFilters";

export default function DataTable({
    columns,
    rows,
    pagination,
    onFilterEvent,
    dense = false,
    ...props
} : DataTableProps) {

    const handleSortRequest = (event: React.MouseEvent<unknown>, property: string) => {
        console.log(event, property);
        onFilterEvent();
    }

    const handleFilterRequest = (field: string, value: string) => {
        console.log('top', 'field', field, 'value', value);
        // TODO: start handling actual filter value data
        // onFilterEvent();
    }

    return (
        <Box>
            <DataTableFilters
                filters={[]}
                onFilterRequest={handleFilterRequest}
            />

            <TableContainer>
                <Table size={dense ? "small" : "medium"}>
                    <TableHead>
                        <TableRow>
                            { columns.map( (column, index) => (
                                <DataTableHeaderCell
                                    key={index}
                                    column={column}
                                    active={false}
                                    direction={'asc'}
                                    onRequestSort={handleSortRequest}
                                />
                            )) }
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        { rows.map( (row, index) => (
                            <TableRow
                                key={index}
                                sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                            >
                                { columns.map( (column, index) => (
                                    <TableCell key={index}>{row[column.field]}</TableCell>
                                )) }
                            </TableRow>
                        )) }
                    </TableBody>
                </Table>
            </TableContainer>

            <TablePagination pagination={pagination} />
        </Box>
    )
}
