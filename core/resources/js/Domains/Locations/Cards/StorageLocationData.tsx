import { useState, useEffect } from 'react';
import { StorageLocationDataProps, JsonObject } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';
import { getUrlParams } from '@/Components/Tables/Filters/params';
import {
    Accordion,
    AccordionDetails,
    AccordionSummary,
    Box,
    Card,
    CardActions,
    CardContent,
    CardHeader,
    Divider,
    Grid,
    Stack,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Typography
} from '@mui/material';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import { getCollectionPagination } from '@/Utils/pagination';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { StorageLocationService } from '@/Services/Locations';
import { CheckBoxOutlineBlank, CheckBoxOutlined } from '@mui/icons-material';
import PrimaryLink from '@/Components/Shared/PrimaryLink';

export default function StorageLocationData({ storageLocations } : StorageLocationDataProps) {
    const { lang } = useLanguage();
    const storageLocationService = new StorageLocationService();
    console.log(storageLocations);

    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState(storageLocations.data.data);
    const [pagination, setPagination] = useState(getCollectionPagination(storageLocations.links, storageLocations.meta));
    const [filterParams, setFilterParams] = useState({});

    const handleFilterEvent = async (filterParams: JsonObject) => {
        const response = await storageLocationService.getStorageLocations(filterParams);

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
            <CardHeader title={lang.storage_locations} />
            <CardContent>
                {data.map((storageLocation) => {
                    const {
                        name,
                        disabled,
                        reservable,
                        restrict_request_allocations
                     } = storageLocation.attributes;

                    const {
                        container_count,
                        location_type,
                        maximum_container_count
                    } = storageLocation.computed;

                    const { containers } = storageLocation.relations;

                    return (
                        <Accordion key={storageLocation.uuid}>
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon />}
                            >
                                <Box sx={{ flexGrow: 1 }}>
                                    <Grid container>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.name}
                                                </Typography>
                                                <PrimaryLink
                                                    route={route('locations.show', { storageLocation: storageLocation.uuid })}
                                                    label={name}
                                                    variant='body1'
                                                />
                                            </Box>
                                        </Grid>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.type}
                                                </Typography>
                                                <Typography variant="body1">{location_type}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.max_containers}
                                                </Typography>
                                                <Typography variant="body1">{maximum_container_count}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.container_count}
                                                </Typography>
                                                <Typography variant="body1">{container_count}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={1}>
                                            <Stack alignItems="center">
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.enabled}
                                                </Typography>
                                                {
                                                    !disabled ? (
                                                        <CheckBoxOutlined />
                                                    ) : (
                                                        <CheckBoxOutlineBlank />
                                                    )
                                                }
                                            </Stack>
                                        </Grid>
                                        <Grid size={1}>
                                            <Stack alignItems="center">
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.reservable}
                                                </Typography>
                                                {
                                                    reservable ? (
                                                        <CheckBoxOutlined />
                                                    ) : (
                                                        <CheckBoxOutlineBlank />
                                                    )
                                                }
                                            </Stack>
                                        </Grid>
                                        <Grid size={1}>
                                            <Stack alignItems="center">
                                                <Typography variant="subtitle2" color="text.secondary">
                                                    {lang.allocatable}
                                                </Typography>
                                                {
                                                    !restrict_request_allocations ? (
                                                        <CheckBoxOutlined />
                                                    ) : (
                                                        <CheckBoxOutlineBlank />
                                                    )
                                                }
                                            </Stack>
                                        </Grid>
                                    </Grid>
                                </Box>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Divider />
                                <Box>
                                    <Typography variant="overline">
                                        {lang.containers}
                                    </Typography>
                                    <Divider />
                                    <TableContainer>
                                        <Table stickyHeader>
                                            <TableHead>
                                                <TableRow>
                                                    <TableCell>
                                                        {lang.part_number}
                                                    </TableCell>
                                                    <TableCell>
                                                        {lang.quantity}
                                                    </TableCell>
                                                    <TableCell>
                                                        {lang.lot_number}
                                                    </TableCell>
                                                </TableRow>
                                            </TableHead>
                                            <TableBody>
                                                {containers.map((container) => {
                                                    const { quantity, lot_number } = container.attributes;
                                                    const { part_number } = container.computed;

                                                    return (
                                                        <TableRow key={container.uuid}>
                                                            <TableCell>{part_number}</TableCell>
                                                            <TableCell>{quantity}</TableCell>
                                                            <TableCell>{lot_number}</TableCell>
                                                        </TableRow>
                                                    )
                                                })}

                                                {containers.length === 0 && (
                                                    <TableRow>
                                                        <TableCell colSpan={3}>
                                                            {lang.no_containers_found}
                                                        </TableCell>
                                                    </TableRow>
                                                )}
                                            </TableBody>
                                        </Table>
                                    </TableContainer>
                                </Box>
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
