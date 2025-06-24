import { useContext, useEffect, useState, useRef } from 'react';
import { router } from '@inertiajs/react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import AuthContext from '@/Contexts/AuthContext';
import LanguageContext from '@/Contexts/LanguageContext';
import StoreContainerHeader from '@/Domains/Production/Layout/Header/StoreContainerHeader';
import { Card, CardContent, CardHeader } from '@mui/material';
import LocationScanInput from '@/Domains/Locations/Inputs/LocationScanInput';
import { LocationLabelService } from '@/Services/Locations';
import { ContainerMovementService } from '@/Services/Materials';

export default function StoreContainer({ materialContainer }: { materialContainer: any }) {
    const { lang } = useContext(LanguageContext);
    const { user } = useContext(AuthContext);
    const containerMovementService = new ContainerMovementService();
    const locationLabelService = new LocationLabelService();

    const [location, setLocation] = useState('');
    const inputRef = useRef<HTMLInputElement | null>(null);

    const handleInputChange = (value: string) => {
        setLocation(value);
    }

    const handleBarcodeScan = async () => {
        console.log(location);
        if (!location) return;

        const locationData = await locationLabelService.getLocationByBarcode(location);
        console.log(locationData);
        if (!locationData) return;

        if (!user) return;

        const movementData = await containerMovementService.initiateContainerMovement(materialContainer.uuid, locationData.uuid, user.uuid);

        if (!movementData) return;

        console.log(movementData);

        if (movementData) {
            router.get(route('production.put-away.scan'));
        }
        else {
            setLocation('');
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
        <SidebarLayout title={lang.put_away}>
            <StoreContainerHeader />

            <Card>
                <CardHeader title={lang.store_container} />
                <CardContent>
                    <LocationScanInput
                        inputRef={inputRef}
                        onChange={handleInputChange}
                        onKeyDown={handleKeyDown}
                        onButtonClick={handleButtonClick}
                        placeholder={`${lang.location}...`}
                        value={location}
                    />
                </CardContent>
            </Card>
        </SidebarLayout>
    );
}
