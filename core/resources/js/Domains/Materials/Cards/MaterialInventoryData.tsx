import { useContext, useState } from 'react';
import axios from 'axios';
import { MaterialInventoryDataProps } from '@/types';
import { getCollectionPagination } from '@/Utils/pagination';
import LanguageContext from '@/Contexts/LanguageContext';
import {
    AccordionDetails,
    Accordion,
    Card,
    CardContent,
    CardHeader,
    Typography,
    AccordionSummary
} from '@mui/material';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';

export default function MaterialInventoryData({ inventory } : MaterialInventoryDataProps) {
    const { lang } = useContext(LanguageContext);

    const records = inventory.data.data;
    const pagination = getCollectionPagination(inventory.links, inventory.meta);

    console.log(records);
    console.log(pagination);

    return (
        <Card sx={{ flexGrow: 1 }}>
            <CardHeader title={lang.material_inventory} />
            <CardContent>

                {records.map((material) => {

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
        </Card>
    )
}
