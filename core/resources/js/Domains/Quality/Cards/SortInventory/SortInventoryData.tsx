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
    Card,
    CardActions,
    CardContent,
    CardHeader,
    Typography,
    Grid,
    Divider,
    Stack,
    TextField,
    Autocomplete,
    IconButton,
    Tooltip
} from '@mui/material';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { SortInventoryService } from '@/Services/Quality';
import { HideSource, History, QrCode } from '@mui/icons-material';
import BarcodeLabelDialog from '@/Domains/Materials/Dialogs/BarcodeLabelDialog';
import SortInventoryHeader from '@/Domains/Quality/Cards/SortInventory/SortInventoryHeader';

export default function SortInventoryData({ inventory, materialOptions } : SortInventoryDataProps) {
    const { lang } = useContext(LanguageContext);
    const sortInventoryService = new SortInventoryService();

    // console.log(inventory);

    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState(inventory.data.data);
    const [pagination, setPagination] = useState(getCollectionPagination(inventory.links, inventory.meta));
    const [filterParams, setFilterParams] = useState({});
    const [barcodeLabelDialogOpen, setBarcodeLabelDialogOpen] = useState(false);
    const [barcodeLabel, setBarcodeLabel] = useState('');

    const handleBarcodeLabelDialogOpen = (barcodeLabel : string) => {
        setBarcodeLabel(barcodeLabel);
        setBarcodeLabelDialogOpen(true);
    };

    const handleBarcodeLabelDialogClose = () => {
        setBarcodeLabelDialogOpen(false);
        setBarcodeLabel('');
    };

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
        // setFilterParams(getUrlParams());
        setLoaded(true);
    }, [])

    return (
        <>
            <Card sx={{ flexGrow: 1 }} elevation={0}>
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

                    <SortInventoryHeader />

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
                                <Grid key={material_container_uuid} container sx={{ py: 1 }}>
                                    <Grid size={1} sx={{ display: 'flex', alignItems: 'center' }}>
                                        <Typography variant="body2" fontWeight="bold">{part_number}</Typography>
                                    </Grid>
                                    <Grid size={1} sx={{ display: 'flex', alignItems: 'center' }}>
                                        <Typography variant="body2">{lot_number}</Typography>
                                    </Grid>
                                    <Grid size={2} sx={{ display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                                        <Typography variant="body2">{quantity}</Typography>
                                    </Grid>
                                    <Grid size={3} sx={{ display: 'flex', alignItems: 'center' }}>
                                        <Typography variant="body2">{storage_location_name}</Typography>
                                    </Grid>
                                    <Grid size={3} sx={{ display: 'flex', alignItems: 'center' }}>
                                        <Typography variant="body2">July 16th, 2024 2:14pm</Typography>
                                    </Grid>
                                    <Grid size={1} sx={{ display: 'flex', alignItems: 'center' }}>
                                        <Tooltip title={lang.view_barcode_label} arrow>
                                            <IconButton onClick={() => handleBarcodeLabelDialogOpen(barcode)}>
                                                <QrCode />
                                            </IconButton>
                                        </Tooltip>
                                    </Grid>
                                    <Grid size={1} sx={{ display: 'flex', alignItems: 'center' }}>
                                        <Stack direction="row" gap={1}>
                                            <Tooltip title={lang.view_history} arrow>
                                                <IconButton>
                                                    <History />
                                                </IconButton>
                                            </Tooltip>
                                            <Tooltip title={lang.clear_skid} arrow>
                                                <IconButton color="danger">
                                                    <HideSource />
                                                </IconButton>
                                            </Tooltip>
                                        </Stack>
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

            <BarcodeLabelDialog
                open={barcodeLabelDialogOpen}
                onClose={handleBarcodeLabelDialogClose}
                barcodeLabel={barcodeLabel}
            />
        </>
    )
}
