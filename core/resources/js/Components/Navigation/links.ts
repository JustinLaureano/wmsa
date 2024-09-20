import {
    Home,
    Factory,
    Inventory,
    LocalShipping,
    PrecisionManufacturing,
    Verified,
    Warehouse,
    AssignmentTurnedIn
} from '@mui/icons-material';

export const navigationDrawerLinks = [
    { label: 'Home', icon: Home, route: route('home') },
    { label: 'Production', icon: PrecisionManufacturing, route: route('production.requests') },
    { label: 'IRM', icon: Factory, route: route('irm.chemicals.inventory') },
    { label: 'Receiving', icon: AssignmentTurnedIn, route: route('receiving.documents') },
    { label: 'Shipping', icon: LocalShipping, route: route('shipping.requests') },
    { label: 'Quality', icon: Verified, route: route('quality.sort') },
    { label: 'Materials', icon: Inventory, route: route('materials.inventory') },
    { label: 'Locations', icon: Warehouse, route: route('locations.buildings.kpi') },
];
