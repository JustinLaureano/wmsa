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

export const navigationDrawerLinks = [
    {
        label:'Home',
        icon: HomeOutlined,
        route: route('home'),
        selected: [
            route('home'),
        ]
    },
    {
        label: 'Production',
        icon: PrecisionManufacturingOutlined,
        route: route('production.requests', { building_id: 1, type: 'transfer' }),
        selected: [
            route('production.requests', { building_id: 1, type: 'transfer' }),
            route('production.requests', { building_id: 2, type: 'transfer' }),
            route('production.requests', { building_id: 3, type: 'transfer' }),
            route('production.requests', { building_id: 1, type: 'phosphate' }),
            route('production.requests', { building_id: 2, type: 'shipping' }),
            route('production.material-request.new'),
            route('production.put-away.scan'),
        ]
    },
    {
        label: 'IRM',
        icon: FactoryOutlined,
        route: route('irm.chemicals.inventory'),
        selected: [
            route('irm.chemicals'),
            route('irm.chemicals.inventory'),
        ]
    },
    {
        label: 'Receiving',
        icon: AssignmentTurnedInOutlined,
        route: route('receiving.documents'),
        selected: [
            route('receiving.documents'),
        ]
    },
    {
        label: 'Shipping',
        icon: LocalShippingOutlined,
        route: route('shipping.requests'),
        selected: [
            route('shipping.requests'),
        ]
    },
    {
        label: 'Quality',
        icon: VerifiedOutlined,
        route: route('quality.sort'),
        selected: [
            route('quality.sort'),
            route('quality.sort.part-numbers'),
        ]
    },
    {
        label: 'Materials',
        icon: InventoryOutlined,
        route: route('materials.inventory'),
        selected: [
            route('materials'),
            route('materials.inventory'),
            route('containers.inventory'),
        ]
    },
    {
        label: 'Locations',
        icon: WarehouseOutlined,
        route: route('locations.buildings.kpi'),
        selected: [
            route('locations.buildings.kpi'),
        ]
    },
];

