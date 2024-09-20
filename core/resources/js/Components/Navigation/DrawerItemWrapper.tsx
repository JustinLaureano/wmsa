import { ReactElement } from "react";
import { SvgIconTypeMap, Tooltip } from "@mui/material"
import { OverridableComponent } from "@mui/material/OverridableComponent";

interface Link {
    label: string;
    icon: OverridableComponent<SvgIconTypeMap<{}, "svg">>;
    route: string;
}

interface DrawerItemWrapperProps {
    navigationDrawerOpen: boolean;
    link: Link;
    children: ReactElement<any, any>;
}

export default function DrawerItemWrapper({ navigationDrawerOpen, link, children, ...props } : DrawerItemWrapperProps) {
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
