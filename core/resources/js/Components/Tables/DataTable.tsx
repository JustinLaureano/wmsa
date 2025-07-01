import { useEffect, useState } from "react";
import { DataTableProps, JsonObject } from "@/types";
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

    const [sortParams, setSortParams] = useState({ field: '', direction: '' });

    const handleSortRequest = (event: React.MouseEvent<unknown>, property: string) => {
        const newSortParams = {
            field: sortParams.field,
            direction: sortParams.direction
        };

        if ( sortParams.field !== property ) {
            newSortParams.field = property;
            newSortParams.direction = '+';
        }
        else {
            const newSortDir = sortParams.direction == '+' ? '-' : '+';

            newSortParams.direction = newSortDir;
        }

        setSortParams(newSortParams)
    }

    const handleFilterRequest = (field: string, operation: string, value: string) => {
        setFilterParams((prevFilterParams : JsonObject) => {
            // Any filter modification should start on a clean page
            delete prevFilterParams['page'];

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

    const handlePageChange = (page: number) => {
        setFilterParams((prevFilterParams : JsonObject) => {
            return {
                ...prevFilterParams,
                'page': page
            };
        });
        
    }

    useEffect(() => {
        if (!loaded) return;

        onFilterEvent(filterParams);
    }, [filterParams])

    useEffect(() => {
        if (!loaded) return;

        setFilterParams((prevFilterParams : JsonObject) => {
            return {
                ...prevFilterParams,
                'sortBy': `${sortParams.direction}${sortParams.field}`
            };
        });
    }, [sortParams])

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
                            { columns.map( (column, index) => {
                                const active = sortParams.field == column.field;
                                const direction = sortParams.field == column.field
                                    ? (sortParams.direction == '+' ? 'asc' : 'desc') 
                                    : 'asc';

                                return (
                                    <DataTableHeaderCell
                                        key={index}
                                        column={column}
                                        active={active}
                                        direction={direction}
                                        onRequestSort={handleSortRequest}
                                    />
                                )
                            }) }
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {(Array.isArray(rows) ? rows : rows.data).map( (row: any, index: number) => {
                            return (
                                <TableRow
                                    key={index}
                                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                >
                                    { columns.map( (column, index) => {
                                        if (column.hasOwnProperty('renderCell') && column.renderCell) {
                                            return (
                                                <TableCell key={index}>
                                                    {column.renderCell({
                                                        row,
                                                        field: column.field,
                                                        index,
                                                        value: row[column.field]
                                                    })}
                                                </TableCell>
                                            )
                                        }

                                        return <TableCell key={index}>{row[column.field]}</TableCell>
                                    }) }
                                </TableRow>
                            )
                        })}
                    </TableBody>
                </Table>
            </TableContainer>

            <TablePagination
                pagination={pagination}
                onChange={handlePageChange}
            />
        </Box>
    )
}
