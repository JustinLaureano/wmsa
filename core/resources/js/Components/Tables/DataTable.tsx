import { useEffect, useState } from "react";
import cloneDeep from 'lodash.clonedeep';
import { JsonObject } from "@/types";
import { DataTableProps } from "./types";
import {
    Box,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow
} from "@mui/material";
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
    const [loaded, setLoaded] = useState(false);
    const [filterParams, setFilterParams] = useState({});

    const handleSortRequest = (event: React.MouseEvent<unknown>, property: string) => {
        // console.log(event, property);
        // TODO: set sort by filter param
        // onFilterEvent();
    }

    const handleFilterRequest = (field: string, operation: string, value: string) => {
        setFilterParams((prevFilterParams : JsonObject) => {
            if (!value) {
                delete prevFilterParams[field];
                return { ...prevFilterParams };
            }

            return {
                ...prevFilterParams,
                [field]: createFilterParamValue(operation, value)
            };
        });
    }

    useEffect(() => {
        if (!loaded) return;

        onFilterEvent(cloneDeep(filterParams));
    }, [filterParams])

    useEffect(() => {
        setFilterParams(getUrlParams());
        setLoaded(true)
    }, [])

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
