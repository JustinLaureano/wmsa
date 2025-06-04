import { useContext, useEffect, useState, useRef } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { BarcodeLabelService } from '@/Services/Materials';
import BarcodeScanInput from '@/Domains/Materials/Inputs/BarcodeScanInput';
import { Card, CardContent, CardHeader } from '@mui/material';

export default function ScanContainer() {
    const { lang } = useContext(LanguageContext);
    const barcodeLabelService = new BarcodeLabelService();

    const [barcode, setBarcode] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (value: string) => {
        setBarcode(value)
    }

    const handleBarcodeScan = async () => {
        const barcodeData = await barcodeLabelService.getBarcodeLabel(barcode);

        if (!barcodeData) return;

        console.log(barcodeData);

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

            <Card
                sx={{
                    maxWidth: '800px',
                    margin: '0 auto',
                    minHeight: '250px',
                }}
            >
                <CardHeader title="Put Away Skid">
                </CardHeader>
                <CardContent>
                    <BarcodeScanInput
                        inputRef={inputRef}
                        onChange={handleInputChange}
                        onKeyDown={handleKeyDown}
                        onButtonClick={handleButtonClick}
                        value={barcode}
                    />
                </CardContent>
            </Card>
        </SidebarLayout>
    );
}
