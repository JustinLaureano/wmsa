import { Drawer, useTheme } from '@mui/material';
import SidebarHeader from './SidebarHeader';
import ConversationsList from './ConversationsList';

interface MessagingSidebarProps {

}

export default function MessagingSidebar({ ...props }: MessagingSidebarProps ) {
    const theme = useTheme();

    return (
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
            <SidebarHeader />
            <ConversationsList />
        </Drawer>
    );
}
