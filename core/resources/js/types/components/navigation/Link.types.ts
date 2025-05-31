import { OverridableComponent } from "@mui/material/OverridableComponent";
import { SvgIconTypeMap } from "@mui/material";

export interface Link {
    label: string;
    icon: OverridableComponent<SvgIconTypeMap<{}, "svg">>;
    route: string;
    selected: string[];
}