import { useContext, useState, useEffect } from 'react';
import {
    MaterialInventoryDataProps,
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
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { MaterialInventoryService } from '@/Services/Materials';

export default function MaterialInventoryData({ inventory, materialOptions } : MaterialInventoryDataProps) {
    const { lang } = useContext(LanguageContext);
    const materialInventoryService = new MaterialInventoryService();

    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState(inventory.data.data);
    const [pagination, setPagination] = useState(getCollectionPagination(inventory.links, inventory.meta));
    const [filterParams, setFilterParams] = useState({});

    const handleFilterEvent = async (filterParams: JsonObject) => {
        const response = await materialInventoryService.getMaterialInventory(filterParams);

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
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.material_inventory} />
            <CardContent>

                <Stack
                    direction="row"
                    alignItems="center"
                    sx={{ p: 1, mb: 2 }}
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
                                    'uuid': value.map((option : MaterialAutocompleteResource) => option.id)
                                };
                            });
                        }}
                        sx={{ width: 400 }}
                        renderInput={(params) => <TextField {...params} label="Part Number" />}
                    />
                </Stack>

                {data.map((material) => {
                    const { material_number, part_number } = material.attributes;
                    const { title, total_quantity_formatted, container_count } = material.computed;
                    const containers = material.relations.containers;

                    return (
                        <Accordion key={material.uuid}>
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon />}
                            >
                                <Box sx={{ flexGrow: 1 }}>
                                    <Grid container>
                                        <Grid size={3}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Part Number</Typography>
                                                <Typography variant="body1">{part_number}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={3}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Material Number</Typography>
                                                <Typography variant="body1">{material_number}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={3}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Container Count</Typography>
                                                <Typography variant="body1">{container_count}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={3}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Total Quantity</Typography>
                                                <Typography variant="body1">{total_quantity_formatted}</Typography>
                                            </Box>
                                        </Grid>
                                    </Grid>
                                </Box>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Typography variant="overline">Containers</Typography>
                                <Divider />
                                <TableContainer>
                                    <Table stickyHeader>
                                        <TableHead>
                                            <TableRow>
                                                <TableCell>Quantity</TableCell>
                                                <TableCell>Lot Number</TableCell>
                                                <TableCell>Location</TableCell>
                                            </TableRow>
                                        </TableHead>
                                        <TableBody>
                                            {containers.map((container) => {

                                                const { quantity, lot_number } = container.attributes;
                                                const { storage_location_name } = container.computed;

                                                return (
                                                    <TableRow key={container.uuid}>
                                                        <TableCell>{quantity}</TableCell>
                                                        <TableCell>{lot_number}</TableCell>
                                                        <TableCell>{storage_location_name}</TableCell>
                                                    </TableRow>
                                                )
                                            })}
                                        </TableBody>
                                    </Table>
                                </TableContainer>
                            </AccordionDetails>
                        </Accordion>
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
