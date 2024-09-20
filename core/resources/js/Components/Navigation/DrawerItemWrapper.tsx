import { ReactElement, useContext } from "react";
import { SvgIconTypeMap, Tooltip } from "@mui/material"
import { OverridableComponent } from "@mui/material/OverridableComponent";
import UIContext from "@/Contexts/UIContext";

interface Link {
    label: string;
    icon: OverridableComponent<SvgIconTypeMap<{}, "svg">>;
    route: string;
}

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
