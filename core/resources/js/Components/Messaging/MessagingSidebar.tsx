import { Drawer, useTheme } from '@mui/material';
import SidebarHeader from './SidebarHeader';
import ConversationsList from './ConversationsList';

export default function MessagingSidebar() {
    const theme = useTheme();

    return (
        <Drawer
            variant="permanent"
            anchor="left"
            open={false}
            PaperProps={{
                style: {
                    position: "absolute",
                    width: theme.layouts.dashboard.conversationDrawerWidth
                }
            }}
        >
            <SidebarHeader />
            <ConversationsList />
        </Drawer>
    );
}
