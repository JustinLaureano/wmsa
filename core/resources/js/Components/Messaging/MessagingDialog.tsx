import { Dialog, DialogContent, useTheme } from '@mui/material';
import { dialogStyleOverrides } from './styles';
import MessagingSidebar from './MessagingSidebar';
import MessagingContent from './MessagingContent';

interface MessagingDialogProps {
    open: boolean;
    onClose: () => void;
}

export default function MessagingDialog({ open, onClose, ...props }: MessagingDialogProps) {
    const theme = useTheme();

    return (
        <Dialog
            open={open}
            onClose={onClose}
            fullWidth={true}
            maxWidth={'lg'}
            sx={dialogStyleOverrides}
        >
            <DialogContent
                sx={{
                    ...(
                        theme.palette.mode == 'dark' && {
                            background: '#1c1f27',
                        }
                    )
                }}
            >

                <MessagingSidebar />

                <MessagingContent />
            </DialogContent>
        </Dialog>
    );
}
