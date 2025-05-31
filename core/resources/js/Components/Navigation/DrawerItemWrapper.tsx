import { useContext } from "react";
import { Tooltip } from "@mui/material"
import UIContext from "@/Contexts/UIContext";
import { DrawerItemWrapperProps } from "@/types";

export default function DrawerItemWrapper({ link, children } : DrawerItemWrapperProps) {
	const { navigationDrawerOpen } = useContext(UIContext);

    if (navigationDrawerOpen) {
        return (
            <>{children}</>
        )
    }

    return (
        <Tooltip
            title={link.label}
            placement="right"
            arrow
        >
            {children}
        </Tooltip>
    )
}
