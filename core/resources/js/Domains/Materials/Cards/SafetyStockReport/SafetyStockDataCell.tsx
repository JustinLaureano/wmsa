import { useContext } from 'react';
import LanguageContext from '@/Contexts/LanguageContext';
import {
    Box,
    Stack,
    TableCell,
    Typography,
    useTheme
} from '@mui/material';

export default function SafetyStockDataCell(
    {
        safetyStock,
        onHand,
        notes,
        difference,
    }: {
        safetyStock: string|null;
        onHand: string|null;
        notes: string|null;
        difference: number|null;
    }
) {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    return (
        <TableCell colSpan={2} sx={{ verticalAlign: 'baseline' }}>
            <Stack direction="row" spacing={1} alignItems="center">
                <Box sx={{ width: '50%', textAlign: 'center' }}>
                    {
                        safetyStock ? (
                            <Typography variant="body2">{safetyStock}</Typography>
                        ) : (
                            <Typography variant="body2" color="text.secondary">n/a</Typography>
                        )
                    }
                </Box>
                <Box sx={{ width: '50%', textAlign: 'center', pl: 5 }}>
                    <Typography variant="body2">{onHand}</Typography>
                </Box>
            </Stack>
            <Box sx={{ textAlign: 'center' }}>
                <Typography variant="body2">{notes}</Typography>
            </Box>
        </TableCell>
    )
}