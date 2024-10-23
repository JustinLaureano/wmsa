import { createContext } from "react";

type UIContextType = {
    navigationDrawerOpen: boolean;
    setNavigationDrawerOpen: (navigationDrawerOpen: boolean) => void;

    messagesDialogOpen: boolean;
    setMessagesDialogOpen: (messagesDialogOpen: boolean) => void;

    loginDialogOpen: boolean;
    setLoginDialogOpen: (loginDialogOpen: boolean) => void;
}

export const defaultUIContext = {
    navigationDrawerOpen: true,
    setNavigationDrawerOpen: () => {},

    messagesDialogOpen: false,
    setMessagesDialogOpen: () => {},

    loginDialogOpen: false,
    setLoginDialogOpen: () => {},
}

const UIContext = createContext<UIContextType>(defaultUIContext);

export default UIContext;
