import { useContext } from 'react';
import { useTheme } from '@mui/material/styles';
import { MaterialRequestsProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { green, red, blue, grey } from '@mui/material/colors';
import { PersonOutlined, ScheduleOutlined, ViewList } from '@mui/icons-material';
import RequestNavTabs from '@/Domains/Production/Layout/Navigation/RequestNavTabs';
import {
    Avatar,
    Chip,
    Stack,
    Typography,
    Box,
    Paper,
    Grid,
    Divider,
} from '@mui/material';
import LocalDateDisplay from '@/Components/Shared/LocalDateDisplay';

export default function MaterialRequests({ requests } : MaterialRequestsProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);
    const list = requests.data;
    console.log(list);
    return (
        <SidebarLayout title={lang.requests}>
            <ProductionPageHeader />

            <Paper variant="outlined" sx={{ maxWidth: '1100px', width: '90vw', margin: '0 auto', p: 5 }}>

                <RequestNavTabs />


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
                                                    <LocalDateDisplay
                                                        utcTime={request.requested_at}
                                                    />
                                                </Typography>
                                            </Stack>
                                        </Box>
                                    </Stack>
                                </Stack>

                                <Stack sx={{ mt: 1 }} spacing={1}>
                                    <Grid container>
                                        <Grid size={2}>
                                            <Typography variant="subtitle2">Part Number</Typography>
                                        </Grid>
                                        <Grid size={2}>
                                            <Typography variant="subtitle2">Order Qty</Typography>
                                        </Grid>
                                        <Grid size={2}>
                                            <Typography variant="subtitle2">Delivered Qty</Typography>
                                        </Grid>
                                        <Grid size={2}>
                                            <Typography variant="subtitle2">Container Type</Typography>
                                        </Grid>
                                        <Grid size={2}>
                                            <Typography variant="subtitle2">Status</Typography>
                                        </Grid>
                                        <Grid size={2}>
                                            <Typography variant="subtitle2">Skids Available</Typography>
                                        </Grid>
                                    </Grid>
                                    <Divider sx={{ color: 'divider' }}/>
                                    {request.items.map((item) => {
                                        return (
                                            <Stack key={item.uuid}>
                                                <Grid container>
                                                    <Grid size={2}>
                                                        <Typography>{item.material_part_number}</Typography>
                                                    </Grid>
                                                    <Grid size={2}>
                                                        <Typography>{item.quantity_requested} {item.unit_of_measure}</Typography>
                                                    </Grid>
                                                    <Grid size={2}>
                                                        <Typography>{item.quantity_delivered} {item.unit_of_measure}</Typography>
                                                    </Grid>
                                                    <Grid size={2}>
                                                        <Typography>{item.material_tote_type_name || 'Any'}</Typography>
                                                    </Grid>
                                                    <Grid size={2}>
                                                        <Typography>{item.status}</Typography>
                                                    </Grid>
                                                    <Grid size={2}>
                                                        <Typography>{item.total_available_material_containers}</Typography>
                                                    </Grid>
                                                </Grid>

                                                <Divider sx={{ color: 'divider' }}/>
                                            </Stack>
                                        );
                                        })}
                                </Stack>
                            </Paper>
                        );
                    })}

                    {list.length === 0 && (
                        <Stack
                            alignItems="center"
                            justifyContent="center"
                        >
                            <ViewList sx={{ fontSize: 200 }} color="disabled" />
                            <Typography variant="body1" color="textSecondary">
                                No requests at this time
                            </Typography>
                        </Stack>
                    )}
                </Stack>
            </Paper>
        </SidebarLayout>
    );
}
