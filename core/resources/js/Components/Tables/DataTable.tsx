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

export default function DataTable({ columns, rows, pagination, dense = false, ...props } : DataTableProps) {
    return (
        <Box>
            <TableContainer>
                <Table size={dense ? "small" : "medium"}>
                    <TableHead>
                        <TableRow>
                            { columns.map( (column, index) => (
                                <TableCell key={index}>{column.headerName}</TableCell>
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
