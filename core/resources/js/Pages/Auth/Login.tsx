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
                        maxWidth: '500px',
                        margin: '0 auto',
                        minHeight: '250px',
                    }}
                >
                    <CardHeader
                        title={lang.login}
                    />
                    <CardContent>
                        <Stack spacing={3}>
                            <TextInput
                                label={lang.username}
                                value={data.username}
                                onChange={value => setData('username', value)}
                                required
                                error={Boolean(errors.username)}
                                helperText={errors.username}
                            />

                            <TextInput
                                label={lang.password}
                                value={data.password}
                                onChange={value => setData('password', value)}
                                required
                                type={showPassword ? "text" : "password"}
                                error={Boolean(errors.password)}
                                helperText={errors.password}
                                slotProps={{
                                    input: {
                                        endAdornment: (
                                            <InputAdornment position="end">
                                                <IconButton
                                                    aria-label={lang.toggle_password_visibility}
                                                    edge="end"
                                                    onClick={handleClickShowPassword}
                                                >
                                                    {showPassword ? <VisibilityOutlined /> : <VisibilityOffOutlined />}
                                                </IconButton>
                                            </InputAdornment>
                                        )
                                    }
                                }}
                            />
                        </Stack>
                    </CardContent>
                    <CardActions sx={{
                        display: 'flex',
                        justifyContent: 'flex-end',
                    }}>
                        <Button type="submit" onClick={submit}>
                            {lang.login}
                        </Button>
                    </CardActions>
                </Card>
            </Stack>
        </SidebarLayout>
    );
}
