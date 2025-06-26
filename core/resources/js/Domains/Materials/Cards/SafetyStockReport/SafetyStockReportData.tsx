import { useState, useEffect } from 'react';
import { SafetyStockReportDataProps, JsonObject } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import {
    Card,
    CardActions,
    CardContent,
    CardHeader,
    Table,
    TableBody,
    TableContainer,
    useTheme
} from '@mui/material';
import { getCollectionPagination } from '@/Utils/pagination';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { getUrlParams } from '@/Components/Tables/Filters/params';
import { SafetyStockReportService } from '@/Services/Materials';
import TableHeader from './TableHeader';
import MaterialTableRow from './MaterialTableRow';

export default function SafetyStockReportData({ safetyStock } : SafetyStockReportDataProps) {
    const { lang } = useLanguage();
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
                        <TableHeader />
                        <TableBody> 
                            {data.map((material) => {
                                return (
                                    <MaterialTableRow
                                        key={material.uuid}
                                        material={material}
                                    />
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
