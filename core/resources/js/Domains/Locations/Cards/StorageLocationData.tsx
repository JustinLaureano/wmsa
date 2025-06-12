import { useContext, useState, useEffect } from 'react';
import { StorageLocationDataProps, JsonObject } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
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
    Grid,
    Stack,
    Typography
} from '@mui/material';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import { getCollectionPagination } from '@/Utils/pagination';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { StorageLocationService } from '@/Services/Locations';
import { CheckBox, CheckBoxOutlineBlank } from '@mui/icons-material';

export default function StorageLocationData({ storageLocations } : StorageLocationDataProps) {
    const { lang } = useContext(LanguageContext);
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
                        max_containers,
                        reservable,
                        restrict_request_allocations
                     } = storageLocation.attributes;

                    return (
                        <Accordion key={storageLocation.uuid}>
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon />}
                            >
                                <Box sx={{ flexGrow: 1 }}>
                                    <Grid container>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Name</Typography>
                                                <Typography variant="body1">{name}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Type</Typography>
                                                <Typography variant="body1">Pallet Rack</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Max Containers</Typography>
                                                <Typography variant="body1">{max_containers}</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={2}>
                                            <Box>
                                                <Typography variant="subtitle2" color="text.secondary">Container Count</Typography>
                                                <Typography variant="body1">1</Typography>
                                            </Box>
                                        </Grid>
                                        <Grid size={1}>
                                            <Stack alignItems="center">
                                                <Typography variant="subtitle2" color="text.secondary">Enabled</Typography>
                                                {
                                                    !disabled ? (
                                                        <CheckBox color="disabled" />
                                                    ) : (
                                                        <CheckBoxOutlineBlank />
                                                    )
                                                }
                                            </Stack>
                                        </Grid>
                                        <Grid size={1}>
                                            <Stack alignItems="center">
                                                <Typography variant="subtitle2" color="text.secondary">Reservable</Typography>
                                                {
                                                    reservable ? (
                                                        <CheckBox color="disabled" />
                                                    ) : (
                                                        <CheckBoxOutlineBlank />
                                                    )
                                                }
                                            </Stack>
                                        </Grid>
                                        <Grid size={1}>
                                            <Stack alignItems="center">
                                                <Typography variant="subtitle2" color="text.secondary">Allocatable</Typography>
                                                {
                                                    !restrict_request_allocations ? (
                                                        <CheckBox color="disabled" />
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
                                <Typography variant="overline">Containers</Typography>
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
