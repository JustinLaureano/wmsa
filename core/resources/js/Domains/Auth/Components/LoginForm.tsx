import React, { useEffect, useRef, useState } from 'react';
import { useForm } from '@inertiajs/react';
import {
    Button,
    Divider,
    IconButton,
    InputAdornment,
    Stack,
    TextField,
    ToggleButton,
    ToggleButtonGroup,
    Typography
} from '@mui/material';
import {
    VisibilityOffOutlined,
    VisibilityOutlined
} from '@mui/icons-material';
import { useLanguage } from '@/Providers/LanguageProvider';
import PrimaryLogo from '@/Components/PrimaryLogo';

const FormStack = ({ children, ...props } : any) => {
    return (
        <Stack
            component="form"
            spacing={2}
            sx={{
                width: '100%',
                minWidth: 350,
            }}
            {...props}
        >
            {children}
        </Stack>
    )
}

export default function LoginForm({ onLoginSuccess = () => {} }: any) {
    const { lang } = useLanguage();

    const loginUsernameRef = useRef<HTMLInputElement>(null);

    // For future use
    // const localEnvironment = props?.ziggy?.location.includes('localhost');
    const [showPassword, setShowPassword] = useState(false);
    const [building, setBuilding] = useState(1);

    const handleClickShowPassword = () => setShowPassword(show => !show);

    /** Form */
    const {
        data: loginData,
        setData: setLoginData,
        post: postLogin,
        processing: loginProcessing,
        errors: loginErrors,
        reset: resetLogin
    } = useForm({
        username: '',
        password: '',
        building_id: 1
    });

    const {
        data: clockinData,
        setData: setClockinData,
        post: postClockin,
        processing: clockinProcessing,
        errors: clockinErrors,
        reset: resetClockin
    } = useForm({
        clock_number: '',
        building_id: 1
    });

    const handleBuildingChange = (e: React.MouseEvent<HTMLElement>, value: number) => {
        setBuilding(value);
        setLoginData('building_id', value);
        setClockinData('building_id', value);
    }

    const handleLoginSubmit = (e: React.MouseEvent<HTMLElement>) => {
        e.preventDefault();

        postLogin(route('login'), {
            onSuccess: (page) => {
                window.location.reload();
            }
        });
    };

    const handleClockinSubmit = (e: React.MouseEvent<HTMLElement>) => {
        e.preventDefault();

        setClockinData('building_id', building);

        postClockin(route('clockin'), {
            onSuccess: (page) => {
                window.location.reload();
            }
        });
    };

    useEffect(() => {
        if (loginUsernameRef.current) {
            loginUsernameRef.current.focus();
        }

        return () => {
            resetLogin();
            resetClockin();
        };
    }, []);

    return (
        <>
            <FormStack onSubmit={handleLoginSubmit}>
                <Stack
                    alignItems="center"
                    spacing={2}
                    sx={{ py: 1 }}
                >
                    <PrimaryLogo />
                    <Typography variant="h6">
                        {lang.warehouse_management_system}
                    </Typography>
                </Stack>

                <Divider />

                <Stack
                    alignItems="center"
                    spacing={2}
                    sx={{ pb: 1, pt: 1 }}
                >
                    <Typography variant="body2" fontWeight={500}>
                        {lang.building}
                    </Typography>
                    <ToggleButtonGroup
                        color="primary"
                        exclusive
                        value={building}
                        onChange={handleBuildingChange}
                    >
                        <ToggleButton value={1}>{lang.plant_2}</ToggleButton>
                        <ToggleButton value={2}>{lang.blackhawk}</ToggleButton>
                        <ToggleButton value={3}>{lang.defiance}</ToggleButton>
                    </ToggleButtonGroup>
                </Stack>

                <Stack
                    alignItems="center"
                    spacing={3}
                    sx={{ pb: 3, pt: 1 }}
                >
                    <Typography variant="h6">
                        {lang.windows_login}
                    </Typography>
                    <TextField
                        inputRef={loginUsernameRef}
                        required
                        value={loginData.username}
                        error={Boolean(loginErrors.username)}
                        helperText={loginErrors.username}
                        label={lang.username}
                        name="username"
                        size="small"
                        fullWidth
                        onChange={e => setLoginData('username', e.target.value)}
                    />
                    <TextField
                        required
                        // required={!localEnvironment}
                        value={loginData.password}
                        error={Boolean(loginErrors.password)}
                        helperText={loginErrors.password}
                        name="password"
                        label={lang.password}
                        type={showPassword ? "text" : "password"}
                        size="small"
                        fullWidth
                        onChange={e => setLoginData('password', e.target.value)}
                        slotProps={{
                            input: {
                                endAdornment: (
                                    <InputAdornment position="end">
                                        <IconButton
                                            aria-label={lang.toggle_password_visibility}
                                            edge="end"
                                            onClick={handleClickShowPassword}
                                        >
                                            {
                                                showPassword
                                                    ? <VisibilityOutlined />
                                                    : <VisibilityOffOutlined />
                                            }
                                        </IconButton>
                                    </InputAdornment>
                                )
                            }
                        }}
                    />

                    <Button
                        type="submit"
                        variant="contained"
                        loading={loginProcessing}
                        disabled={loginProcessing}
                        fullWidth
                    >
                        {lang.login}
                    </Button>
                </Stack>
            </FormStack>

            <Stack
                direction="row"
                spacing={2}
                alignItems="center"
                justifyContent="center"
                sx={{ my: 1 }}
            >
                <Divider sx={{ flex: 1 }} />
                <Typography variant="body2">
                    {lang.or.toUpperCase()}
                </Typography>
                <Divider sx={{ flex: 1 }} />
            </Stack>

            <FormStack onSubmit={handleClockinSubmit}>
                <Stack
                    alignItems="center"
                    spacing={3}
                    sx={{ pb: 1, pt: 1 }}
                >
                    <Typography variant="h6">
                        {lang.badge_clock_in}
                    </Typography>

                    <TextField
                        required
                        value={clockinData.clock_number}
                        error={Boolean(clockinErrors.clock_number)}
                        helperText={clockinErrors.clock_number}
                        label={lang.clock_number}
                        name="clock_number"
                        size="small"
                        fullWidth
                        onChange={e => setClockinData('clock_number', e.target.value)}
                    />

                    <Button
                        type="submit"
                        variant="contained"
                        loading={clockinProcessing}
                        disabled={clockinProcessing}
                        fullWidth
                    >
                        {lang.clock_in}
                    </Button>
                </Stack>
            </FormStack>
        </>
    );
}
