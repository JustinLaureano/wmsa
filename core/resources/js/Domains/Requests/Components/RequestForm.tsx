import React, { useContext } from 'react';
import { useForm } from '@inertiajs/react';
import {
    Box,
    Button, Stack, Typography
} from '@mui/material';
import LanguageContext from '@/Contexts/LanguageContext';
import { StackProps } from '@mui/material/Stack';

const FormStack = ({ children, ...props } : any) => {
    return (
        <Stack {...props}>{children}</Stack>
    )
}

export default function RequestForm({ onSubmitSuccess = () => {} }: any) {
    const lang = useContext(LanguageContext);

    /** Form */
    const { data, setData, post, processing, errors, reset, clearErrors } = useForm({
        part_id: 1,
        location_id: 5
    });

    const handleSubmit = (e: React.MouseEvent<HTMLElement>) => {
        e.preventDefault();

        post(route('request.create'), {
            onSuccess: page => {
                onSubmitSuccess();
            }
        });
    };

    return (
        <FormStack
            component="form"
            onSubmit={handleSubmit}
            spacing={2}
        >
            <Box>
                <Typography>Part ID: {data.part_id}</Typography>
                <Typography>Location ID: {data.location_id}</Typography>
            </Box>

            <Stack sx={{ pt: 2 }}>
                <Button type="submit" variant="contained">
                    Create Request
                </Button>
            </Stack>
        </FormStack>
    );
}
