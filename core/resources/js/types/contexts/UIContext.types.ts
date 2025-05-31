export type UIContextType = {
    navigationDrawerOpen: boolean;
    setNavigationDrawerOpen: (navigationDrawerOpen: boolean) => void;

    messagesDialogOpen: boolean;
    setMessagesDialogOpen: (messagesDialogOpen: boolean) => void;

    loginDialogOpen: boolean;
    setLoginDialogOpen: (loginDialogOpen: boolean) => void;
}
