import { Dialog, DialogContent, useTheme } from '@mui/material';
import { dialogStyleOverrides } from './styles';
import MessagingSidebar from './MessagingSidebar';
import MessagingContent from './MessagingContent';

interface MessagingDialogProps {
    open: boolean;
    onClose: () => void;
}

export default function MessagingDialog({ open, onClose, ...props }: MessagingDialogProps) {

    return (
        <Dialog
            open={open}
            onClose={onClose}
            fullWidth={true}
            maxWidth={'lg'}
            sx={dialogStyleOverrides}
        >
            <DialogContent>

                <MessagingSidebar />

                <MessagingContent />
            </DialogContent>
        </Dialog>
    );
}
