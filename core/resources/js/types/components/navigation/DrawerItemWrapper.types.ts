import { ReactElement } from "react";
import { Link } from "./Link.types";

export interface DrawerItemWrapperProps {
    link: Link;
    children: ReactElement<any, any>;
}