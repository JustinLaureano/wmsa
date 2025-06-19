import { useContext, useState } from 'react';
import { IrmChemicalInventoryDataProps } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import { Box, Card, CardContent, CardHeader, IconButton, Table, TableBody, TableCell, TableContainer, TableHead, Typography, useTheme } from '@mui/material';
import IrmChemicalSearchFilter from '../Filters/IrmChemicalSearchFilter';
import { Stack } from '@mui/material';
import { toLocalTime } from '@/Utils/date';
import StyledTableRow from '@/Components/Styled/StyledTableRow';
import { HistoryOutlined } from '@mui/icons-material';

const filters = [
    { component: IrmChemicalSearchFilter },
];

export default function IrmChemicalInventoryData({ inventory } : IrmChemicalInventoryDataProps) {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    return (
        <Card
            sx={{
                width: '90vw',
                maxWidth: '1000px',
                margin: '0 auto',
            }}
        >
            <CardHeader title={lang.irm_chemical_inventory} />
            <CardContent>
                {inventory.map((item) => {
                    const {
                        part_number,
                        total_quantity,
                        unit_of_measure_label,
                    } = item.computed;
                    const {
                        inventory,
                    } = item.relations;

                    return (
                        <Box
                            key={item.uuid}
                            sx={{
                                marginBottom: 4,
                                paddingBottom: 4,
                                borderBottom: `1px solid ${theme.palette.divider}`,
                            }}
                        >
                            <Stack
                                direction="row"
                                justifyContent="space-between"
                                alignItems="center"
                                sx={{
                                    px: 1,
                                }}
                            >
                                <Stack direction="row" spacing={1} alignItems="center">
                                    <Typography variant="subtitle1" fontWeight="bold">{lang.part_number}:</Typography>
                                    <Typography variant="body1">{part_number}</Typography>
                                    <IconButton size="small">
                                        <HistoryOutlined />
                                    </IconButton>
                                </Stack>
                                <Stack direction="row" spacing={1} alignItems="center">
                                    <Typography variant="subtitle1" fontWeight="bold">{lang.total_quantity}:</Typography>
                                    <Typography variant="body1">{total_quantity} {unit_of_measure_label}</Typography>
                                </Stack>
                            </Stack>
                            <TableContainer>
                                <Table>
                                    <TableHead>
                                        <TableCell width="25%">
                                            <Typography variant="overline" fontWeight="bold" color="primary">Location</Typography>
                                        </TableCell>
                                        <TableCell width="25%">
                                            <Typography variant="overline" fontWeight="bold" color="primary">Quantity</Typography>
                                        </TableCell>
                                        <TableCell width="35%">
                                            <Typography variant="overline" fontWeight="bold" color="primary">Stored At</Typography>
                                        </TableCell>
                                        <TableCell width="15%" align="center">
                                            <Typography variant="overline" fontWeight="bold" color="primary">History</Typography>
                                        </TableCell>
                                    </TableHead>
                                    <TableBody>
                                        {inventory.map((item) => {

                                            const {
                                                storage_location_name,
                                                irm_chemical_quantity,
                                                stored_at,
                                            } = item.computed;

                                            return (
                                                <StyledTableRow key={item.uuid}>
                                                    <TableCell>{storage_location_name}</TableCell>
                                                    <TableCell>{irm_chemical_quantity}</TableCell>
                                                    <TableCell>{toLocalTime(stored_at, 'MMMM dd, yyyy hh:mm a')}</TableCell>
                                                    <TableCell align="center">
                                                        <IconButton size="small">
                                                            <HistoryOutlined />
                                                        </IconButton>
                                                    </TableCell>
                                                </StyledTableRow>
                                            )
                                        })}
                                    </TableBody>
                                </Table>
                            </TableContainer>
                        </Box>
                    )
                })}
            </CardContent>
        </Card>
    )
}
