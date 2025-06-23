import { useContext, useState, useEffect } from 'react';
import { SafetyStockReportDataProps, JsonObject } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import {
    Box,
    Card,
    CardActions,
    CardContent,
    CardHeader,
    Stack,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Typography,
    useTheme
} from '@mui/material';
import { getCollectionPagination } from '@/Utils/pagination';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { getUrlParams } from '@/Components/Tables/Filters/params';
import { SafetyStockReportService } from '@/Services/Materials';

export default function SafetyStockReportData({ safetyStock } : SafetyStockReportDataProps) {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();
    const safetyStockReportService = new SafetyStockReportService();

    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState(safetyStock.data.data);
    const [pagination, setPagination] = useState(getCollectionPagination(safetyStock.links, safetyStock.meta));
    const [filterParams, setFilterParams] = useState({});

    const handleFilterEvent = async (filterParams: JsonObject) => {
        const response = await safetyStockReportService.getSafetyStockReport(filterParams);

        if ( !response ) return;

        setData(response.data.data);
        setPagination(getCollectionPagination(response.links, response.meta));
        return;
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

        handleFilterEvent(filterParams);
    }, [filterParams]);

    useEffect(() => {
        setFilterParams(getUrlParams());
        setLoaded(true);
    }, []);

    return (
        <Card elevation={0} sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.safety_stock} />
            <CardContent>
                <TableContainer>
                    <Table stickyHeader>
                        <TableHead>
                            <TableRow>
                                <TableCell sx={{ borderBottom: 'none' }} />
                                <TableCell
                                    align="center"
                                    colSpan={2}
                                    sx={{
                                        borderLeft: `1px solid ${theme.palette.divider}`,
                                        borderBottom: 'none'
                                    }}
                                >
                                    <Typography variant="overline" fontWeight="bold" color="primary">Plant 2</Typography>
                                </TableCell>
                                <TableCell
                                    align="center"
                                    colSpan={2}
                                    sx={{
                                        borderLeft: `1px solid ${theme.palette.divider}`,
                                        borderBottom: 'none'
                                    }}
                                >
                                    <Typography variant="overline" fontWeight="bold" color="primary">Blackhawk</Typography>
                                </TableCell>
                                <TableCell
                                    align="center"
                                    colSpan={2}
                                    sx={{
                                        borderLeft: `1px solid ${theme.palette.divider}`,
                                        borderBottom: 'none'
                                    }}
                                >
                                    <Typography variant="overline" fontWeight="bold" color="primary">Defiance</Typography>
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell>
                                    <Typography variant="subtitle2" fontWeight="bold">{lang.part_number}</Typography>
                                </TableCell>
                                <TableCell align="center" sx={{ borderLeft: `1px solid ${theme.palette.divider}` }}>
                                    <Typography variant="subtitle2" fontWeight="bold">Safety Stock</Typography>
                                </TableCell>
                                <TableCell align="center">
                                    <Typography variant="subtitle2" fontWeight="bold">On Hand</Typography>
                                </TableCell>
                                <TableCell align="center" sx={{ borderLeft: `1px solid ${theme.palette.divider}` }}>
                                    <Typography variant="subtitle2" fontWeight="bold">Safety Stock</Typography>
                                </TableCell>
                                <TableCell align="center">
                                    <Typography variant="subtitle2" fontWeight="bold">On Hand</Typography>
                                </TableCell>
                                <TableCell align="center" sx={{ borderLeft: `1px solid ${theme.palette.divider}` }}>
                                    <Typography variant="subtitle2" fontWeight="bold">Safety Stock</Typography>
                                </TableCell>
                                <TableCell align="center">
                                    <Typography variant="subtitle2" fontWeight="bold">On Hand</Typography>
                                </TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody> 
                        {data.map((item) => {
                            const {
                                part_number,
                                building_1_safety_stock,
                                building_1_on_hand,
                                building_1_uom,
                                building_1_notes,
                                building_2_safety_stock,
                                building_2_on_hand,
                                building_2_uom,
                                building_2_notes,
                                building_3_safety_stock,
                                building_3_on_hand,
                                building_3_uom,
                                building_3_notes,
                            } = item.attributes;
                            return (
                                <TableRow key={item.uuid}>
                                    <TableCell sx={{ verticalAlign: 'baseline' }}>
                                        <Typography variant="subtitle2">{part_number}</Typography>
                                    </TableCell>
                                    <TableCell colSpan={2} sx={{ verticalAlign: 'baseline' }}>
                                        <Stack direction="row" spacing={1}>
                                            <Box sx={{ width: '50%', textAlign: 'center' }}>
                                                {
                                                    building_1_safety_stock ? (
                                                        <Typography variant="body2">{building_1_safety_stock} {building_1_uom}</Typography>
                                                    ) : (
                                                        <Typography variant="body2" color="text.secondary">n/a</Typography>
                                                    )
                                                }
                                            </Box>
                                            <Box sx={{ width: '50%', textAlign: 'center', pl: 5 }}>
                                                <Typography variant="body2">{building_1_on_hand} {building_1_uom}</Typography>
                                            </Box>
                                        </Stack>
                                        <Box sx={{ textAlign: 'center' }}>
                                            <Typography variant="body2">{building_1_notes}</Typography>
                                        </Box>
                                    </TableCell>
                                    <TableCell colSpan={2} sx={{ verticalAlign: 'baseline' }}>
                                        <Stack direction="row" spacing={1} alignItems="center">
                                            <Box sx={{ width: '50%', textAlign: 'center' }}>
                                                {
                                                    building_2_safety_stock ? (
                                                        <Typography variant="body2">{building_2_safety_stock} {building_2_uom}</Typography>
                                                    ) : (
                                                        <Typography variant="body2" color="text.secondary">n/a</Typography>
                                                    )
                                                }
                                            </Box>
                                            <Box sx={{ width: '50%', textAlign: 'center', pl: 5 }}>
                                                <Typography variant="body2">{building_2_on_hand} {building_2_uom}</Typography>
                                            </Box>
                                        </Stack>
                                        <Box sx={{ textAlign: 'center' }}>
                                            <Typography variant="body2">{building_2_notes}</Typography>
                                        </Box>
                                    </TableCell>
                                    <TableCell colSpan={2} sx={{ verticalAlign: 'baseline' }}>
                                        <Stack direction="row" spacing={1} alignItems="center">
                                            <Box sx={{ width: '50%', textAlign: 'center' }}>
                                                {
                                                    building_3_safety_stock ? (
                                                        <Typography variant="body2">{building_3_safety_stock} {building_3_uom}</Typography>
                                                    ) : (
                                                        <Typography variant="body2" color="text.secondary">n/a</Typography>
                                                    )
                                                }
                                            </Box>
                                            <Box sx={{ width: '50%', textAlign: 'center', pl: 5 }}>
                                                <Typography variant="body2">{building_3_on_hand} {building_3_uom}</Typography>
                                            </Box>
                                        </Stack>
                                        <Box sx={{ textAlign: 'center' }}>
                                            <Typography variant="body2">{building_3_notes}</Typography>
                                        </Box>
                                    </TableCell>
                                </TableRow>
                            )
                        })}
                        </TableBody>
                    </Table>
                </TableContainer>
            </CardContent>
            <CardActions
                sx={{
                    display: 'flex',
                    justifyContent: 'flex-end',
                }}
            >
                <CollectionPagination
                    pagination={pagination}
                    onChange={handlePageChange}
                />
            </CardActions>
        </Card>
    )
}
