import { FormEventHandler, useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { useForm } from '@inertiajs/react';
import {
    Button,
    Card,
    CardActions,
    CardContent,
    CardHeader,
    IconButton,
    InputAdornment,
    Stack
} from '@mui/material';
import TextInput from '@/Components/Inputs/TextInput';
import { VisibilityOffOutlined, VisibilityOutlined } from '@mui/icons-material';
import { useLanguage } from '@/Providers/LanguageProvider';
import LoginForm from '@/Domains/Auth/Components/LoginForm';

export default function Login({ referrer }: { referrer: string }) {
    const { lang } = useLanguage();

    const { data, setData, post, processing, errors, reset } = useForm({
        username: '',
        password: '',
        remember: false,
    });

    const [showPassword, setShowPassword] = useState(false);
    const handleClickShowPassword = () => setShowPassword(show => !show);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onSuccess: (page) => {
                if (referrer) {
                    window.location.href = referrer;
                }
                else {
                    window.location.reload();
                }
            }
        });
    };

    return (
        <SidebarLayout title={lang.login}>
            <Stack
                direction="row"
                justifyContent="center"
                alignItems="center"
                height="80%"
            >
                <Card
                    sx={{
                        width: '70vw',
                        maxWidth: '450px',
                        margin: '0 auto',
                        minHeight: '250px',
                    }}
                >
                    <CardContent>
                        <LoginForm />
                    </CardContent>
                </Card>
            </Stack>
        </SidebarLayout>
    );
}
