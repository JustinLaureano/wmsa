import { useEffect, useState, useRef } from 'react';
import { router } from '@inertiajs/react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useLanguage } from '@/Providers/LanguageProvider';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { BarcodeLabelService } from '@/Services/Materials';
import BarcodeScanInput from '@/Domains/Materials/Inputs/BarcodeScanInput';
import { Card, CardContent, CardHeader } from '@mui/material';

export default function ScanContainer() {
    const { lang } = useLanguage();
    const barcodeLabelService = new BarcodeLabelService();

    const [barcode, setBarcode] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (value: string) => {
        setBarcode(value);
    }

    const handleBarcodeScan = async () => {
        const barcodeData = await barcodeLabelService.getBarcodeLabel(barcode);

        if (!barcodeData) return;

        console.log(barcodeData);

        if (barcodeData.container) {
            router.get(route('production.put-away.container', { materialContainer: barcodeData.container.uuid }));
        }
        else {
            setBarcode('');
            focusInput();
        }
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
                <CardHeader title={lang.put_away_skid} />
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
