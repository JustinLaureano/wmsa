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
import { JsonObject } from '@/types';

export function getNavigationDrawerLinks(lang: JsonObject) {
    const navigationDrawerLinks = [
        {
            label: lang.home,
            icon: HomeOutlined,
            route: route('home'),
            selected: [
                route('home'),
            ]
        },
        {
            label: lang.production,
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
                route('machines'),
            ]
        },
        {
            label: lang.irm,
            icon: FactoryOutlined,
            route: route('irm.chemicals.inventory'),
            selected: [
                route('irm.chemicals'),
                route('irm.chemicals.inventory'),
            ]
        },
        {
            label: lang.receiving,
            icon: AssignmentTurnedInOutlined,
            route: route('receiving.documents'),
            selected: [
                route('receiving.documents'),
            ]
        },
        {
            label: lang.shipping,
            icon: LocalShippingOutlined,
            route: route('shipping.requests'),
            selected: [
                route('shipping.requests'),
            ]
        },
        {
            label: lang.quality,
            icon: VerifiedOutlined,
            route: route('quality.sort'),
            selected: [
                route('quality.sort'),
                route('quality.sort.part-numbers'),
                route('quality.sort.inventory', { storage_location_building_id: 1 }),
                route('quality.sort.inventory', { storage_location_building_id: 2 }),
            ]
        },
        {
            label: lang.materials,
            icon: InventoryOutlined,
            route: route('materials.inventory'),
            selected: [
                route('materials'),
                route('materials.inventory'),
                route('containers.inventory'),
                route('materials.safety-stock'),
                route('materials.safety-stock', { material_type_code: 'IRM' }),
                route('materials.safety-stock', { material_type_code: 'CMET' }),
                route('materials.safety-stock', { material_type_code: 'COMP' }),
            ]
        },
        {
            label: lang.locations,
            icon: WarehouseOutlined,
            route: route('locations.buildings.kpi'),
            selected: [
                route('locations.buildings.kpi'),
                route('locations.show'),
            ]
        },
    ];

    return navigationDrawerLinks;
}
