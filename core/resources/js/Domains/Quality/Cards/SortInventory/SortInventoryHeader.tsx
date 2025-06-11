import { useContext } from 'react';
import {
    Typography,
    Grid,
    Divider,
} from '@mui/material';
import LanguageContext from '@/Contexts/LanguageContext';

export default function SortInventoryHeader() {
    const { lang } = useContext(LanguageContext);

    return (
        <>
            <Grid
                container
                sx={{
                    flexGrow: 1,
                }}
            >
                <Grid size={1}>
                    <Typography variant="overline" fontWeight="bold" color="primary">{lang.part}</Typography>
                </Grid>
                <Grid size={1}>
                    <Typography variant="overline" fontWeight="bold" color="primary">Lot</Typography>
                </Grid>
                <Grid size={2} sx={{ display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                    <Typography variant="overline" fontWeight="bold" color="primary">Qty</Typography>
                </Grid>
                <Grid size={3}>
                    <Typography variant="overline" fontWeight="bold" color="primary">Location</Typography>
                </Grid>
                <Grid size={3}>
                    <Typography variant="overline" fontWeight="bold" color="primary">Dropped Off</Typography>
                </Grid>
                <Grid size={1}>
                    <Typography variant="overline" fontWeight="bold" color="primary">Label</Typography>
                </Grid>
                <Grid size={1}>
                    <Typography variant="overline" fontWeight="bold" color="primary">Actions</Typography>
                </Grid>
            </Grid>

            <Divider />
        </>
    );
}