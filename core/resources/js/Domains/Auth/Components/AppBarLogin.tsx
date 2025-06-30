import { useContext } from 'react';
import {
    Box,
    Button,
    Dialog,
    DialogContent,
    Typography,
} from '@mui/material';
import { Person2Outlined } from '@mui/icons-material';
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
                    disableElevation
                    variant="contained"
                    color="info"
                    size="small"
                    startIcon={<Person2Outlined />}
                    onClick={handleLoginButtonClick}
                    sx={{
                        pr: 3,
                        pl: 2
                    }}
                >
                    <Typography variant="subtitle2" fontWeight={400}>
                        {lang.login}
                    </Typography>
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
