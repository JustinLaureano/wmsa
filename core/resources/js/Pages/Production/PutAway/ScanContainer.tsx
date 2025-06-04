import { useContext, useEffect, useState, useRef } from 'react';
import { useTheme } from '@mui/material/styles';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { BarcodeLabelService } from '@/Services/Materials';
import BarcodeScanInput from '@/Domains/Materials/Inputs/BarcodeScanInput';

export default function ScanContainer() {
    const theme = useTheme();
    const { lang } = useContext(LanguageContext);
    const barcodeLabelService = new BarcodeLabelService();

    const [barcode, setBarcode] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (value: string) => {
        setBarcode(value)
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

            <BarcodeScanInput
                onChange={handleInputChange}
                onKeyDown={handleKeyDown}
                onButtonClick={handleButtonClick}
                value={barcode}
                placeholder={'Scan a barcode'}
            />
        </SidebarLayout>
    );
}
