import { useContext, useState, useEffect } from 'react';
import {
    SortInventoryDataProps,
    JsonObject,
    MaterialAutocompleteResource
} from '@/types';
import { getCollectionPagination } from '@/Utils/pagination';
import LanguageContext from '@/Contexts/LanguageContext';
import { getUrlParams } from '@/Components/Tables/Filters/params';
import {
    AccordionDetails,
    Accordion,
    Card,
    CardActions,
    CardContent,
    CardHeader,
    Typography,
    AccordionSummary,
    Box,
    Grid,
    TableContainer,
    Table,
    TableHead,
    TableRow,
    TableCell,
    TableBody,
    Divider,
    Stack,
    TextField,
    Autocomplete
} from '@mui/material';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { SortInventoryService } from '@/Services/Quality';

export default function SortInventoryData({ inventory, materialOptions } : SortInventoryDataProps) {
    const { lang } = useContext(LanguageContext);
    const sortInventoryService = new SortInventoryService();

    console.log(inventory);

    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState(inventory.data.data);
    const [pagination, setPagination] = useState(getCollectionPagination(inventory.links, inventory.meta));
    const [filterParams, setFilterParams] = useState({});

    const handleFilterEvent = async (filterParams: JsonObject) => {
        const response = await sortInventoryService.getSortInventory(filterParams);

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
    }, [filterParams])

    useEffect(() => {
        setFilterParams(getUrlParams());
        setLoaded(true);
    }, [])

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.sort_inventory} sx={{ pt: 2, pb: 0}} />
            <CardContent>
                <Stack
                    direction="row"
                    alignItems="center"
                    sx={{ px: 1, pb: 2 }}
                    gap={2}
                >
                    <Autocomplete
                        multiple
                        filterSelectedOptions
                        options={materialOptions}
                        onChange={(event, value) => {
                            setFilterParams((prevFilterParams : JsonObject) => {
                                return {
                                    ...prevFilterParams,
                                    'material_uuid': value.map((option : MaterialAutocompleteResource) => option.id)
                                };
                            });
                        }}
                        sx={{ width: 400 }}
                        renderInput={(params) => <TextField {...params} label="Part Number" />}
                    />
                </Stack>

                <Grid
                    container
                    sx={{
                        flexGrow: 1,
                    }}
                >
                    <Grid size={1}>
                        <Typography variant="overline" color="">Item</Typography>
                    </Grid>
                    <Grid size={2}>
                        <Typography variant="overline" color="">Lot</Typography>
                    </Grid>
                    <Grid size={1}>
                        <Typography variant="overline" color="">Qty</Typography>
                    </Grid>
                    <Grid size={3}>
                        <Typography variant="overline" color="">Location</Typography>
                    </Grid>
                    <Grid size={3}>
                        <Typography variant="overline" color="">Dropped Off</Typography>
                    </Grid>
                    <Grid size={1}>
                        <Typography variant="overline" color="">Label</Typography>
                    </Grid>
                    <Grid size={1}>
                        <Typography variant="overline" color="">Actions</Typography>
                    </Grid>
                </Grid>

                <Divider />

                {data.map((container) => {
                    const {
                        material_container_uuid,
                        material_uuid,
                        barcode,
                        lot_number,
                        quantity,
                        part_number,
                        storage_location_name,
                    } = container;

                    return (
                        <>
                            <Grid container sx={{ py: 1 }}>
                                <Grid size={1}>
                                    <Typography variant="body2">{part_number}</Typography>
                                </Grid>
                                <Grid size={2}>
                                    <Typography variant="body2">{lot_number}</Typography>
                                </Grid>
                                <Grid size={1}>
                                    <Typography variant="body2">{quantity}</Typography>
                                </Grid>
                                <Grid size={3}>
                                    <Typography variant="body2">{storage_location_name}</Typography>
                                </Grid>
                                <Grid size={3}>
                                    <Typography variant="body2">July 16th, 2024 2:14pm</Typography>
                                </Grid>
                                <Grid size={1}>
                                    <Typography variant="body2">icon</Typography>
                                </Grid>
                                <Grid size={1}>
                                    <Typography variant="subtitle2">Actions</Typography>
                                </Grid>
                            </Grid>
                            <Divider />
                        </>
                    )
                })}
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
