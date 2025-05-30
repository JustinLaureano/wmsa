import { useContext } from 'react';
import { useTheme } from '@mui/material/styles';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { MaterialRequestListCollection } from '@/types/requests';
import { green, red, blue, grey } from '@mui/material/colors';
import { PersonOutlined, ScheduleOutlined } from '@mui/icons-material';
import {
    Avatar,
    Chip,
    Stack,
    Typography,
    Box,
    Table,
    TableBody,
    TableRow,
    TableCell,
    TableHead,
    Paper,
    Tabs,
    Tab,
} from '@mui/material';
interface MaterialRequestsProps {
    requests: MaterialRequestListCollection;
}

export default function MaterialRequests({ requests } : MaterialRequestsProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);
    const list = requests.data;
    console.log(list);
    return (
        <SidebarLayout title={lang.requests}>
            <ProductionPageHeader />

            <Paper variant="outlined" sx={{ maxWidth: '1100px', width: '90vw', margin: '0 auto', p: 5 }}>

                <Box sx={{ borderBottom: 1, borderColor: 'divider', mb: 4 }}>
                    <Tabs
                        value={0}
                        sx={{
                            '& .MuiTabs-flexContainer': {
                                justifyContent: 'center',
                            }
                        }}
                    >
                        <Tab label="Plant 2" />
                        <Tab label="Blackhawk" />
                        <Tab label="Defiance" />
                        <Tab label="Phosphate" />
                        <Tab label="Shipping" />

                    </Tabs>
                </Box>


                <Stack spacing={2} sx={{
                    maxWidth: '1000px',
                    margin: '0 auto',
                }}>
                    {list.map((request) => {
                        let backgroundColor:string = blue[300];
                        let color:string = theme.palette.success.contrastText;

                        if (request.status === 'Cancelled') {   
                            backgroundColor = red[600];
                            color = theme.palette.error.contrastText;
                        }

                        if (request.status === 'Completed') {
                            backgroundColor = green[600];
                            color = theme.palette.primary.contrastText;
                        }

                        return (
                            <Paper key={request.uuid} sx={{ p: 2, mb: `${theme.spacing(2)} !important`, borderLeft: `3px solid ${backgroundColor}` }}>
                                <Stack direction="row" justifyContent="space-between" sx={{ px: 2, pb: 2, mb: 2, borderBottom: 1, borderColor: grey[500] }}>
                                    <Box>
                                        <Typography variant="h6" color="textPrimary">{request.title}</Typography>
                                        <Chip label={request.status} size="small" sx={{ mt: .5, backgroundColor, color }} />
                                    </Box>
                                    <Stack>
                                        <Box>
                                            <Stack direction="row" alignItems="center" spacing={1}>
                                                <Avatar sx={{ backgroundColor: 'transparent', width: 24, height: 24 }}>
                                                    <PersonOutlined color="primary" />
                                                </Avatar>
                                                <Typography variant="body2" fontWeight={400} color="textPrimary">
                                                    {request.requester_name}
                                                </Typography>
                                            </Stack>
                                            <Stack direction="row" alignItems="center" spacing={1}>
                                                <Avatar sx={{ backgroundColor: 'transparent', width: 24, height: 24 }}>
                                                    <ScheduleOutlined color="primary" />
                                                </Avatar>
                                                <Typography variant="body2" fontWeight={400} color="textPrimary">
                                                    {request.requested_at}
                                                </Typography>
                                            </Stack>
                                        </Box>
                                    </Stack>
                                </Stack>

                                <Stack sx={{ mt: 1 }}>
                                    {request.items.map((item) => {
                                            return (
                                                <Box key={item.uuid}>
                                                    <Table size="small">
                                                        <TableHead>
                                                            <TableRow>
                                                                <TableCell>Part Number</TableCell>
                                                                <TableCell>Location</TableCell>
                                                                <TableCell>Quantity</TableCell>
                                                                <TableCell>Container</TableCell>
                                                            </TableRow>
                                                        </TableHead>
                                                        <TableBody>
                                                            <TableRow>
                                                                <TableCell>{item.material_part_number}</TableCell>
                                                                <TableCell>{item.machine_name || item.storage_location_name || 'None'}</TableCell>
                                                                <TableCell>
                                                                    {item.quantity_delivered} / {item.quantity_requested} {item.unit_of_measure}
                                                                </TableCell>
                                                                <TableCell>
                                                                    {item.container_allocation?.location || '-na'}
                                                                </TableCell>
                                                            </TableRow>
                                                        </TableBody>
                                                    </Table>
                                                </Box>
                                            );
                                        })}
                                </Stack>
                            </Paper>
                        );
                    })}

                </Stack>
            </Paper>

        </SidebarLayout>
    );
}
