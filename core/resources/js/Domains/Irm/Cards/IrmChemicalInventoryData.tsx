import { useContext, useState } from 'react';
import { IrmChemicalInventoryDataProps } from '@/types';
import LanguageContext from '@/Contexts/LanguageContext';
import {
    Box,
    Card,
    CardContent,
    CardHeader,
    IconButton,
    Stack,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    Typography,
    useTheme,
} from '@mui/material';
import { toLocalTime } from '@/Utils/date';
import StyledTableRow from '@/Components/Styled/StyledTableRow';
import { HistoryOutlined } from '@mui/icons-material';
import SearchInput from '@/Components/Inputs/SearchInput';

export default function IrmChemicalInventoryData({ inventory } : IrmChemicalInventoryDataProps) {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    const [data, setData] = useState(inventory);
    const [search, setSearch] = useState('');

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSearch(e.target.value);

        setData(inventory.filter((item) => {
            return item.computed
                .part_number
                .toLowerCase()
                .includes(e.target.value.toLowerCase())
        }));
    }

    return (
        <Card
            sx={{
                width: '90vw',
                maxWidth: '1000px',
                margin: '0 auto',
            }}
        >
            <CardHeader title={lang.irm_chemical_inventory} />
            <CardContent>
                <Stack direction="row" spacing={1} alignItems="center" sx={{ mb: 4 }}>
                    <SearchInput
                        label={lang.chemical}
                        value={search}
                        onChange={handleInputChange}
                    />
                </Stack>

                {data.map((item) => {
                    const {
                        part_number,
                        total_quantity,
                        unit_of_measure_label,
                    } = item.computed;
                    const {
                        inventory,
                    } = item.relations;

                    return (
                        <Box
                            key={item.uuid}
                            sx={{
                                marginBottom: 4,
                                paddingBottom: 4,
                                borderBottom: `1px solid ${theme.palette.divider}`,
                            }}
                        >
                            <Stack
                                direction="row"
                                justifyContent="space-between"
                                alignItems="center"
                                sx={{
                                    px: 1,
                                }}
                            >
                                <Stack direction="row" spacing={1} alignItems="center">
                                    <Typography variant="subtitle1" fontWeight="bold">{lang.part_number}:</Typography>
                                    <Typography variant="body1">{part_number}</Typography>
                                    <IconButton size="small">
                                        <HistoryOutlined />
                                    </IconButton>
                                </Stack>
                                <Stack direction="row" spacing={1} alignItems="center">
                                    <Typography variant="subtitle1" fontWeight="bold">{lang.total_quantity}:</Typography>
                                    <Typography variant="body1">{total_quantity.toLocaleString()} {unit_of_measure_label}</Typography>
                                </Stack>
                            </Stack>
                            <TableContainer>
                                <Table>
                                    <TableHead>
                                        <TableCell width="25%">
                                            <Typography
                                                variant="overline"
                                                fontWeight="bold"
                                                color="primary"
                                            >
                                                {lang.location}
                                            </Typography>
                                        </TableCell>
                                        <TableCell width="25%">
                                            <Typography
                                                variant="overline"
                                                fontWeight="bold"
                                                color="primary"
                                            >
                                                {lang.quantity}
                                            </Typography>
                                        </TableCell>
                                        <TableCell width="35%">
                                            <Typography
                                                variant="overline"
                                                fontWeight="bold"
                                                color="primary"
                                            >
                                                {lang.stored_at}
                                            </Typography>
                                        </TableCell>
                                        <TableCell width="15%" align="center">
                                            <Typography
                                                variant="overline"
                                                fontWeight="bold"
                                                color="primary"
                                            >
                                                {lang.history}
                                            </Typography>
                                        </TableCell>
                                    </TableHead>
                                    <TableBody>
                                        {inventory.map((item) => {

                                            const {
                                                storage_location_name,
                                                irm_chemical_quantity,
                                                stored_at,
                                            } = item.computed;

                                            return (
                                                <StyledTableRow key={item.uuid}>
                                                    <TableCell>{storage_location_name}</TableCell>
                                                    <TableCell>{irm_chemical_quantity.toLocaleString()} {unit_of_measure_label}</TableCell>
                                                    <TableCell>{toLocalTime(stored_at, 'MMMM dd, yyyy hh:mm a')}</TableCell>
                                                    <TableCell align="center">
                                                        <IconButton size="small">
                                                            <HistoryOutlined />
                                                        </IconButton>
                                                    </TableCell>
                                                </StyledTableRow>
                                            )
                                        })}
                                        {
                                            inventory.length === 0 &&
                                            <StyledTableRow>
                                                <TableCell colSpan={4} align="center">
                                                    <Typography variant="body1">{lang.no_inventory_found}</Typography>
                                                </TableCell>
                                            </StyledTableRow>
                                        }
                                    </TableBody>
                                </Table>
                            </TableContainer>
                        </Box>
                    )
                })}
            </CardContent>
        </Card>
    )
}
