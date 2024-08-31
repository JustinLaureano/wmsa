import { createContext } from "react";

type UIContextType = {
    navigationDrawerOpen: boolean;
    setNavigationDrawerOpen: (navigationDrawerOpen: boolean) => void;

    loginDialogOpen: boolean;
    setLoginDialogOpen: (navigationDrawerOpen: boolean) => void;
}

export const defaultUIContext = {
    navigationDrawerOpen: true,
    setNavigationDrawerOpen: () => {},

    loginDialogOpen: false,
    setLoginDialogOpen: () => {},
}

const UIContext = createContext<UIContextType>(defaultUIContext);

export default UIContext;
