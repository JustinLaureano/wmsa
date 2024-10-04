import { useEffect, useState } from "react";
import cloneDeep from 'lodash.clonedeep';
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
import { createFilterParamValue, getUrlParams } from "./Filters/params";
import DataTableFilters from "./Filters/DataTableFilters";
import DataTableHeaderCell from "./DataTableHeaderCell";
import TablePagination from "./TablePagination";

export default function DataTable({
    columns,
    rows,
    pagination,
    filters = [],
    onFilterEvent,
    dense = false,
    ...props
} : DataTableProps) {
    const [filterParams, setFilterParams] = useState(getUrlParams());

    const handleSortRequest = (event: React.MouseEvent<unknown>, property: string) => {
        console.log(event, property);
        // TODO: set sort by filter param
        // onFilterEvent();
    }

    const handleFilterRequest = (field: string, operation: string, value: string) => {
        setFilterParams(prevFilterParams => {
            return {
                ...prevFilterParams,
                [field]: createFilterParamValue(operation, value)
            };
        });


    }

    useEffect(() => {
        console.log(filterParams)
        // onFilterEvent(cloneDeep(filterParams));
    }, [filterParams])

    return (
        <Box>
            <DataTableFilters
                filters={filters}
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
