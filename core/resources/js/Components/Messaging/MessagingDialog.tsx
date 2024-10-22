import { useState } from 'react';
import { Dialog, DialogContent, useTheme } from '@mui/material';

interface MessagingDialogProps {
    children: React.ReactNode;
}

export default function MessagingDialog({ children, ...props }: MessagingDialogProps) {
    const theme = useTheme();
    const [open, setOpen] = useState(false);

    const handleClose = () => setOpen(false);

    return (
        <Dialog
            open={open}
            onClose={handleClose}
        >
            <DialogContent>
                {children}
            </DialogContent>
        </Dialog>
    );
}
