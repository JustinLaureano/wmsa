import { Dialog, DialogContent, Drawer, useTheme } from '@mui/material';
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
                <Drawer
                    variant="permanent"
                    anchor="left"
                    open={false}
                    PaperProps={{
                        style: {
                            position: "absolute",
                            width: '300px'
                        }
                    }}
                >
                    <div>conversations</div>
                </Drawer>
            </DialogContent>
        </Dialog>
    );
}
