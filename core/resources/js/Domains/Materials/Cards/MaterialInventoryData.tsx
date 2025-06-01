import { useContext, useState, useEffect } from 'react';
import {
    MaterialInventoryDataProps,
    JsonObject
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
} from '@mui/material';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import MaterialService from '@/Services/MaterialService';

export default function MaterialInventoryData({ inventory } : MaterialInventoryDataProps) {
    const { lang } = useContext(LanguageContext);
    const materialService = new MaterialService();

    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState(inventory.data.data);
    const [pagination, setPagination] = useState(getCollectionPagination(inventory.links, inventory.meta));
    const [filterParams, setFilterParams] = useState({});

    const handleFilterEvent = async (filterParams: JsonObject) => {
        const response = await materialService.getMaterialInventory(filterParams);

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
            <CardHeader title={lang.material_inventory} />
            <CardContent>

                {data.map((material) => {

                    const containers = material.relations.containers;

                    return (
                        <Accordion key={material.uuid}>
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon />}
                            >
                                <Typography>{material.computed.title}</Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                {containers.map((container) => (
                                    <Typography key={container.uuid}>{container.attributes.barcode}</Typography>
                                ))}
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
