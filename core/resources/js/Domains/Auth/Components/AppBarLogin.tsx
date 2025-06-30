import { useContext } from 'react';
import { grey } from '@mui/material/colors';
import {
    Box,
    Button,
    Dialog,
    DialogContent,
} from '@mui/material';
import { AccountCircle } from '@mui/icons-material';
import UIContext from '@/Contexts/UIContext';
import { useLanguage } from '@/Providers/LanguageProvider';
import LoginForm from './LoginForm';

export default function AppBarLogin(props: any) {
    const { lang } = useLanguage();
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
                    {lang.login}
                </Button>
            </Box>

            <Dialog
                open={loginDialogOpen}
                onClose={handleCloseDialog}
                maxWidth={false}
            >
                <DialogContent>
                    <LoginForm onLoginSuccess={handleCloseDialog} />
                </DialogContent>
            </Dialog>
        </>
    );
}
