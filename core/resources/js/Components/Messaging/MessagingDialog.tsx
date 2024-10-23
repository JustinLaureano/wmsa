import { Box, Dialog, DialogContent, Drawer, Stack, useTheme } from '@mui/material';
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
            maxWidth={'lg'}
            sx={dialogStyleOverrides}
        >
            <DialogContent>

                <Drawer
                    variant="permanent"
                    anchor="left"
                    open={false}
                    PaperProps={{
                        style: {
                            position: "absolute",
                            width: '320px'
                        }
                    }}
                >
                    <div>conversations</div>
                </Drawer>

                <Stack sx={{ marginLeft: '320px' }}>
                    Dialog Content Here
                </Stack>

            </DialogContent>
        </Dialog>
    );
}
