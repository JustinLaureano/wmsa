import { useContext, useState } from 'react';
import { Paper, Stack, TextField } from '@mui/material';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import RequestService from '@/Services/RequestService';
import { MaterialRequestData } from '@/types/requests';
import ComboBox from '@/Components/Inputs/ComboBox';
import TextInput from '@/Components/Inputs/TextInput';

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
    const { machines } = props;
    const [selectedMachine, setSelectedMachine] = useState<MachineOptionResource | null>(null);
    const [partNumber, setPartNumber] = useState<string>('');
    const [quantity, setQuantity] = useState<number>(1);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        if (!selectedMachine) return;

        const requestData: MaterialRequestData = {
            machine_uuid: selectedMachine.uuid,
            part_number: partNumber,
            quantity: quantity
        };

        const response = await new RequestService().createMaterialRequest(requestData);

        if (response) {
            // Handle successful creation
            setSelectedMachine(null);
            setPartNumber('');
            setQuantity(1);
        }
    };

    return (
        <DashboardLayout title={lang.requests}>
            <ProductionPageHeader />

            <Paper 
                elevation={0}
                sx={{ 
                    p: 3,
                    maxWidth: '600px',
                    margin: '0 auto'
                }}
            >
                <form onSubmit={handleSubmit}>
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

                        <TextField
                            label="Quantity"
                            type="number"
                            value={quantity}
                            onChange={(e) => setQuantity(parseInt(e.target.value))}
                            size="small"
                            required
                            inputProps={{
                                min: 1,
                                step: 1
                            }}
                            sx={{
                                width: '100px',
                                '& .MuiOutlinedInput-input': {
                                    '&:focus': {
                                        boxShadow: 'none',
                                        borderColor: 'transparent',
                                        outline: 'none',
                                    },
                                }
                            }}
                        />
                    </Stack>
                </form>
            </Paper>
        </DashboardLayout>
    );
}
