import { useContext, useState, useEffect } from 'react';
import { StorageLocationDataTableProps, JsonObject } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import { getUrlParams } from '@/Components/Tables/Filters/params';
import { Card, CardActions, CardContent, CardHeader } from '@mui/material';
import { getCollectionPagination } from '@/Utils/pagination';
import CollectionPagination from '@/Components/Shared/CollectionPagination';
import { StorageLocationService } from '@/Services/Locations';

export default function StorageLocationDataTable({ storageLocations } : StorageLocationDataTableProps) {
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
                    return (
                        <div key={storageLocation.uuid}>
                            {storageLocation.attributes.name}
                        </div>
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
