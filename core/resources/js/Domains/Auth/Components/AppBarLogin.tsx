import React, { useContext } from 'react';
import { grey } from '@mui/material/colors';
import {
    Box, Button, Dialog, DialogContent,
    DialogContentText, DialogTitle
} from '@mui/material';
import { AccountCircle } from '@mui/icons-material';
import UIContext from '@/Contexts/UIContext';
import LanguageContext from '@/Contexts/LanguageContext';
import LoginForm from './LoginForm';

export default function AppBarLogin(props: any) {
    const lang = useContext(LanguageContext);
    const { loginDialogOpen, setLoginDialogOpen } = useContext(UIContext);

    const handleLoginButtonClick = () => {
        setLoginDialogOpen(true);
    }

    const handleCloseDialog = () => {
        setLoginDialogOpen(false);
    }

    return (
        <>
            <Box>
                <Button
                    variant="text"
                    startIcon={<AccountCircle sx={{ color: grey[700] }} />}
                    onClick={handleLoginButtonClick}
                >
                    Login
                </Button>
            </Box>

            <Dialog
                open={loginDialogOpen}
                onClose={handleCloseDialog}
                maxWidth={false}
            >
                <DialogTitle>Login</DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        Yada ya
                    </DialogContentText>

                    <LoginForm onLoginSuccess={handleCloseDialog} />

                </DialogContent>
            </Dialog>
        </>
    );
}
