import React from 'react';
import { useLanguage } from '@/Providers/LanguageProvider';
import {
    Box,
    Stack,
    TableCell,
    Tooltip,
    Typography,
    useTheme
} from '@mui/material';
import { WarningAmberOutlined } from '@mui/icons-material';

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
    const { lang } = useLanguage();
    const theme = useTheme();

    return (
        <TableCell
            colSpan={3}
            sx={{
                verticalAlign: 'baseline',
                backgroundColor: difference && difference < 0 ? theme.palette.error.light : 'transparent',
            }}
        >
            <Stack direction="row" spacing={1} alignItems="center">
                <Box sx={{ width: '10%', textAlign: 'center' }}>
                    {difference && difference < 0 ? (
                        <Tooltip
                            arrow
                            title={
                                <React.Fragment>
                                    <Typography variant="body2" color="inherit">
                                        {`${lang.difference}: ${difference}`}
                                    </Typography>
                              </React.Fragment>
                            }
                        >
                            <WarningAmberOutlined
                                sx={{
                                    color: theme.palette.error.dark,
                                }}
                            />
                        </Tooltip>
                    ) : ''}
                </Box>
                <Box sx={{ width: '45%', textAlign: 'center', pl: 4 }}>
                    {
                        safetyStock ? (
                            <Typography
                                variant="body2"
                                sx={{
                                    fontWeight: difference && difference < 0 ? 'bold' : 'normal',
                                }}
                            >{safetyStock}</Typography>
                        ) : (
                            <Typography variant="body2" color="text.secondary">{lang.na}</Typography>
                        )
                    }
                </Box>
                <Box sx={{ width: '45%', textAlign: 'center', pl: 5 }}>
                    <Typography
                        variant="body2"
                        sx={{
                            fontWeight: difference && difference < 0 ? 'bold' : 'normal',
                        }}
                    >{onHand}</Typography>
                </Box>
            </Stack>
            <Box sx={{ pt: 1 }}>
                <Typography variant="body2">
                    {notes ? `${lang.note}: ${notes}` : ''}
                </Typography>
            </Box>
        </TableCell>
    )
}