import { useContext, useState } from 'react';
import {
    Card,
    CardContent,
    CardHeader,
    Stack,
    TextField,
    Typography,
    useTheme,
} from '@mui/material';
import { ViewSortListPartNumbersProps } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import QualityPageHeader from '@/Domains/Quality/Layout/Header/QualityPageHeader';
import OverflowScrollBox from '@/Components/Shared/OverflowScrollBox';

export default function ViewSortListPartNumbers({ partNumbers }: ViewSortListPartNumbersProps) {
    const { lang } = useContext(LanguageContext);
    const theme = useTheme();

    const [search, setSearch] = useState('');

    const filteredPartNumbers = partNumbers.filter((partNumber) => (
        partNumber.toLowerCase().includes(search.toLowerCase())
    ));

    return (
        <SidebarLayout title={lang.inventory}>
            <QualityPageHeader />

            <Card sx={{ mb: theme.spacing(4) }}>
                <CardHeader title="Sort List Part Numbers" />
                <CardContent>
                    <Stack direction="row" spacing={2}>
                        <TextField
                            label="Search"
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                        />
                    </Stack>

                    <OverflowScrollBox
                        sx={{
                            display: 'flex',
                            flexDirection: 'column',
                            alignItems: 'center',
                            gap: 2,
                        }}
                    >
                        {filteredPartNumbers.map((partNumber) => (
                            <Typography key={partNumber}>{partNumber}</Typography>
                        ))}

                        {filteredPartNumbers.length === 0 && (
                            <Typography>No part numbers found</Typography>
                        )}
                    </OverflowScrollBox>
                </CardContent>
            </Card>
        </SidebarLayout>
    );
}
