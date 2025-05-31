import { createContext } from "react";
import { UIContextType } from "@/types";

export const defaultUIContext = {
    navigationDrawerOpen: true,
    setNavigationDrawerOpen: () => {},

    messagesDialogOpen: false,
    setMessagesDialogOpen: () => {},

    loginDialogOpen: false,
    setLoginDialogOpen: () => {},
}

export default createContext<UIContextType>(defaultUIContext);
