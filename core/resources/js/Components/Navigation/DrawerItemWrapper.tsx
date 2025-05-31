import { ReactElement, useContext } from "react";
import { Tooltip } from "@mui/material"
import UIContext from "@/Contexts/UIContext";
import { Link } from "@/types";

interface DrawerItemWrapperProps {
    link: Link;
    children: ReactElement<any, any>;
}

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
