import React, { useContext, useEffect, useState } from 'react';
import { useForm } from '@inertiajs/react';
import {
    Button, IconButton,
    InputAdornment, Stack, TextField
} from '@mui/material';
import {
    VisibilityOffOutlined,
    VisibilityOutlined
} from '@mui/icons-material';
import LanguageContext from '@/Contexts/LanguageContext';
import AuthContext from '@/Contexts/AuthContext';

const FormStack = ({ children, ...props } : any) => {
    return (
        <Stack {...props}>{children}</Stack>
    )
}

export default function LoginForm({ onLoginSuccess = () => {} }: any) {
    const lang : Record<string, any> = useContext(LanguageContext);
    const { setUser } = useContext(AuthContext);

    // For future use
    // const localEnvironment = props?.ziggy?.location.includes('localhost');
    const [showPassword, setShowPassword] = useState(false);

    const handleClickShowPassword = () => setShowPassword(show => !show);

    /** Form */
    const { data, setData, post, processing, errors, reset, clearErrors } = useForm({
        email: '',
        password: ''
    });

    const handleSubmit = (e: React.MouseEvent<HTMLElement>) => {
        e.preventDefault();

        post(route('login'), {
            onSuccess: (page : Record<string, any>) => {
                reset();
                clearErrors();
                setUser(page.props.auth.user);

                onLoginSuccess();
            }
        });
    };

    useEffect(() => {
        // TODO: focus input

        return () => {
            reset('password');
        };
    }, []);

    return (
        <FormStack
            component="form"
            onSubmit={handleSubmit}
            spacing={2}
        >

            <TextField
                required
                value={data.email}
                error={Boolean(errors.email)}
                helperText={errors.email}
                label={lang.email}
                name="email"
                size="small"
                fullWidth
                onChange={e => setData('email', e.target.value)}
            />

            <TextField
                required
                // required={!localEnvironment}
                value={data.password}
                error={Boolean(errors.password)}
                helperText={errors.password}
                name="password"
                label={lang.password}
                type={showPassword ? "text" : "password"}
                size="small"
                fullWidth
                onChange={e => setData('password', e.target.value)}
                InputProps={{
                    endAdornment: (
                        <InputAdornment position="end">
                            <IconButton
                                aria-label="toggle password visibility"
                                edge="end"
                                onClick={handleClickShowPassword}
                            >
                                {showPassword ? <VisibilityOutlined /> : <VisibilityOffOutlined />}
                            </IconButton>
                        </InputAdornment>
                    )
                }}
            />

            <Stack sx={{ pt: 2 }}>
                <Button type="submit" variant="contained" fullWidth>
                    Login
                </Button>
            </Stack>
        </FormStack>
    );
}
