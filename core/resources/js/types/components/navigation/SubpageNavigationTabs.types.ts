import { SxProps } from "@mui/material";
import { NavigationTab } from "../tabs";

export interface SubpageNavigationTabsProps {
    tabs: NavigationTab[];
    centered?: boolean;
    sx?: SxProps;
}