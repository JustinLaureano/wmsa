import { FormEvent, useContext, useState } from 'react';
import { Card, CardHeader, CardContent, CardActions, Button, Stack } from '@mui/material';
import { CreateNewMaterialRequestProps, MachineOptionResource, MaterialRequestFormData } from '@/types';
import SidebarLayout from '@/Layouts/SidebarLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import RequestService from '@/Services/RequestService';
import ComboBox from '@/Components/Inputs/ComboBox';
import TextInput from '@/Components/Inputs/TextInput';
import { useAuth } from '@/Providers/AuthProvider';

export default function CreateNewMaterialRequest({ ...props }: CreateNewMaterialRequestProps) {
    const { lang } = useContext(LanguageContext);
    const { user } = useAuth();

    const { machines } = props;
    const [selectedMachine, setSelectedMachine] = useState<MachineOptionResource | null>(null);
    const [partNumber, setPartNumber] = useState<string>('');
    const [quantity, setQuantity] = useState<number>(1);

    const handleSubmit = async (e: FormEvent) => {
        e.preventDefault();

        if (!selectedMachine || !user?.uuid) return;

        const requestData: MaterialRequestFormData = {
            machine_uuid: selectedMachine.uuid,
            storage_location_uuid: null,
            part_number: partNumber,
            quantity: quantity,
            unit_of_measure: 'cont',
            requester_user_uuid: user.uuid,
            requested_at: new Date()
        };

        const response = await new RequestService()
            .createMaterialRequest(requestData);

        if (response) {
            handleClear();
        }
    };

    const handleClear = () => {
        setSelectedMachine(null);
        setPartNumber('');
        setQuantity(1);
    };

    return (
        <SidebarLayout title={lang.requests}>
            <ProductionPageHeader />

            <Card
                sx={{ 
                    maxWidth: '600px',
                    margin: '0 auto'
                }}
            >
                <CardHeader title={lang.new_material_request} />
                
                <form onSubmit={handleSubmit}>
                    <CardContent>
                        <Stack spacing={3}>
                            <ComboBox
                                options={machines}
                                inputLabel={lang.choose_a_machine}
                                value={selectedMachine}
                                onChange={(value) => setSelectedMachine(value as MachineOptionResource)}
                            />

                            <TextInput
                                label={lang.part_number}
                                value={partNumber}
                                onChange={setPartNumber}
                                required
                            />
                            
                            <TextInput
                                label={lang.quantity}
                                type="number"
                                value={quantity}
                                onChange={(value) => setQuantity(parseInt(value))}
                                required
                                inputProps={{
                                    min: 1,
                                    step: 1
                                }}
                                sx={{ width: '100px' }}
                            />
                        </Stack>
                    </CardContent>

                    <CardActions sx={{ justifyContent: 'flex-end', p: 2 }}>
                        <Button 
                            onClick={handleClear}
                            variant="outlined"
                        >
                            {lang.clear}
                        </Button>
                        <Button 
                            type="submit"
                            variant="contained"
                            color="primary"
                        >
                            {lang.create}
                        </Button>
                    </CardActions>
                </form>
            </Card>
        </SidebarLayout>
    );
}
