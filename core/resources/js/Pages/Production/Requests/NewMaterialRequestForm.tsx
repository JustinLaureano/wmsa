import { useContext } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import LanguageContext from '@/Contexts/LanguageContext';
import ProductionPageHeader from '@/Domains/Production/Layout/Header/ProductionPageHeader';
import { Autocomplete, Box, TextField } from '@mui/material';

interface MachineOptionResource {
    uuid: string;
    label: string;
    value: string;
}

interface NewMaterialRequestFormProps {
    machines: MachineOptionResource[];
}

export default function NewMaterialRequestForm({ ...props } : NewMaterialRequestFormProps) {
    const { lang } = useContext(LanguageContext);
    const { machines } = props;

    return (
        <DashboardLayout title={lang.requests}>
            <ProductionPageHeader />

            <Autocomplete
                id="machine-autocomplete"
                options={machines}
                getOptionLabel={(option) => option.label}
                renderOption={(props, option) => {
                    const { key, ...optionProps } = props;
                    return (
                        <Box
                            key={key}
                            component="li"
                            {...optionProps}
                        >
                            {option.label}
                        </Box>
                    );
                }}
                renderInput={(params) => (
                    <TextField
                        {...params}
                        label="Choose a machine"
                        autoComplete='off'
                    />
                )}
            />

        </DashboardLayout>
    );
}
