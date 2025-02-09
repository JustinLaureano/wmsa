import { useContext, useState } from 'react';
import axios from 'axios';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import { Button, Card,CardActions, CardContent, CardHeader, Stack, Typography, useTheme } from '@mui/material';
import HomeTabs from '@/Components/HomeTabs';

interface ContainersTestProps {}

export default function ContainersTest({ ...props } : ContainersTestProps) {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);

    const [barcodeValue, setBarcodeValue] = useState('');

    const handleButtonClick: React.MouseEventHandler<HTMLButtonElement> = (event) =>{
        const params = { barcode: btoa(barcodeValue) };

        axios.get(route('api.materials.container', params))
            .then(res => console.log(res))
    }

    return (
        <SidebarLayout title={lang.inventory}>
            <Stack sx={{ mb: theme.spacing(4) }}>
                <Typography variant="h3">Test - Containers</Typography>
                <HomeTabs />
            </Stack>
            <Stack sx={{ mb: 4 }}>
                <Card sx={{ flexGrow: 1 }}>
                    <CardHeader title={'Barcode Scanning'} />
                    <CardContent>

                        <input
                            type="text"
                            value={barcodeValue}
                            onChange={(e) => setBarcodeValue(e.target.value)}
                            placeholder="Scan Barcode"
                            style={{
                                minWidth: "900px"
                            }}
                        />

                    </CardContent>
                    <CardActions>
                        <Button onClick={handleButtonClick}>Search</Button>
                    </CardActions>
                </Card>
            </Stack>
        </SidebarLayout>
    );
}
