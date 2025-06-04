import { useContext, useEffect, useState, useRef } from 'react';
import { useTheme } from '@mui/material/styles';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import {
    Paper,
    Stack,
    Divider,
    IconButton,
} from '@mui/material';
import { Send } from '@mui/icons-material';
import StyledInputBase from '@/Components/Styled/StyledInputBase';
import { BarcodeLabelService } from '@/Services/Materials';

export default function ScanContainer() {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);
    const barcodeLabelService = new BarcodeLabelService();

    const [barcode, setBarcode] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setBarcode(e.target.value)
    }

    const handleBarcodeScan = async () => {
        const barcodeLabel = await barcodeLabelService.getBarcodeLabel(barcode);

        if (!barcodeLabel) return;

        console.log(barcodeLabel);

        setBarcode('');
        focusInput();
    }

    const handleButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        handleBarcodeScan();
    }

    const handleKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key !== 'Enter') return;

        e.preventDefault();
        handleBarcodeScan();
    }

    const focusInput = () => {
        if (inputRef.current) {
            inputRef.current.focus();
        }
    }

    useEffect(() => focusInput(), []);

    return (
        <SidebarLayout title={lang.requests}>
            <ProductionPageHeader />


            <Paper
                elevation={0}
                variant="outlined"
                sx={{
                    p: '3px 8px',
                    minWidth: '240px',
                    boxShadow: 'none'
                }}
            >
                <Stack
                    direction="row"
                    alignItems="center"
                >
                    <StyledInputBase
                        inputRef={inputRef}
                        placeholder={'Scan a barcode'}
                        value={barcode}
                        onChange={handleInputChange}
                        onKeyDown={handleKeyDown}
                        multiline
                        maxRows={2}
                        sx={{ flexGrow: 1 }}
                    />

                    <Divider
                        orientation="vertical"
                        flexItem
                        sx={{ mr: 1 }}
                    />

                    <IconButton
                        color="gray"
                        onClick={handleButtonClick}
                    >
                        <Send />
                    </IconButton>
                </Stack>
            </Paper>


        </SidebarLayout>
    );
}
