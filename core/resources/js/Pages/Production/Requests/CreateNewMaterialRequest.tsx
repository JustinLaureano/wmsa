import { useContext, useState } from 'react';
import { Card, CardHeader, CardContent, CardActions, Button, Stack } from '@mui/material';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import RequestService from '@/Services/RequestService';
import { MaterialRequestData } from '@/types/requests';
import ComboBox from '@/Components/Inputs/ComboBox';
import TextInput from '@/Components/Inputs/TextInput';
import AuthContext from '@/Contexts/AuthContext';

interface MachineOptionResource {
    uuid: string;
    label: string;
    value: string;
}

interface CreateNewMaterialRequestProps {
    machines: MachineOptionResource[];
}

export default function CreateNewMaterialRequest({ ...props }: CreateNewMaterialRequestProps) {
    const { lang } = useContext(LanguageContext);
    const { user } = useContext(AuthContext);

    const { machines } = props;
    const [selectedMachine, setSelectedMachine] = useState<MachineOptionResource | null>(null);
    const [partNumber, setPartNumber] = useState<string>('');
    const [quantity, setQuantity] = useState<number>(1);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        if (!selectedMachine || !user?.uuid) return;

        const requestData: MaterialRequestData = {
            machine_uuid: selectedMachine.uuid,
            storage_location_uuid: null,
            part_number: partNumber,
            quantity: quantity,
            unit_of_measure: 'CONT',
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
        <DashboardLayout title={lang.requests}>
            <ProductionPageHeader />

            <Card 
                sx={{ 
                    maxWidth: '600px',
                    margin: '0 auto'
                }}
            >
                <CardHeader title="New Material Request" />
                
                <form onSubmit={handleSubmit}>
                    <CardContent>
                        <Stack spacing={3}>
                            <ComboBox
                                options={machines}
                                inputLabel="Choose a machine"
                                value={selectedMachine}
                                onChange={(value) => setSelectedMachine(value as MachineOptionResource)}
                            />

                            <TextInput
                                label="Part Number"
                                value={partNumber}
                                onChange={setPartNumber}
                                required
                            />
                            
                            <TextInput
                                label="Quantity"
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
                            color="inherit"
                        >
                            Clear
                        </Button>
                        <Button 
                            type="submit"
                            variant="contained"
                            color="primary"
                        >
                            Create
                        </Button>
                    </CardActions>
                </form>
            </Card>
        </DashboardLayout>
    );
}
