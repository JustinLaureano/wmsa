import { Dialog, DialogContent, useTheme } from '@mui/material';
import { MessagingDialogProps } from '@/types';
import { dialogStyleOverrides } from './styles';
import MessagingSidebar from './MessagingSidebar';
import MessagingContent from './MessagingContent';

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
                    padding: 0,
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
