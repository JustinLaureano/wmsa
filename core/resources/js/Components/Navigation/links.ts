import { OverridableComponent } from "@mui/material/OverridableComponent";
import {
    HomeOutlined,
    FactoryOutlined,
    InventoryOutlined,
    LocalShippingOutlined,
    PrecisionManufacturingOutlined,
    VerifiedOutlined,
    WarehouseOutlined,
    AssignmentTurnedInOutlined
} from '@mui/icons-material';
import { SvgIconTypeMap } from "@mui/material";

export const navigationDrawerLinks = [
    { label: 'Home', icon: HomeOutlined, route: route('home') },
    { label: 'Production', icon: PrecisionManufacturingOutlined, route: route('production.requests') },
    { label: 'IRM', icon: FactoryOutlined, route: route('irm.chemicals.inventory') },
    { label: 'Receiving', icon: AssignmentTurnedInOutlined, route: route('receiving.documents') },
    { label: 'Shipping', icon: LocalShippingOutlined, route: route('shipping.requests') },
    { label: 'Quality', icon: VerifiedOutlined, route: route('quality.sort') },
    { label: 'Materials', icon: InventoryOutlined, route: route('materials.inventory') },
    { label: 'Locations', icon: WarehouseOutlined, route: route('locations.buildings.kpi') },
];

export interface Link {
    label: string;
    icon: OverridableComponent<SvgIconTypeMap<{}, "svg">>;
    route: string;
}
