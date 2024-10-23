import { Dialog, DialogContent, useTheme } from '@mui/material';
import { dialogStyleOverrides } from './styles';

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
            maxWidth={'xl'}
            sx={dialogStyleOverrides}
        >
            <DialogContent>
                Dialog
            </DialogContent>
        </Dialog>
    );
}
