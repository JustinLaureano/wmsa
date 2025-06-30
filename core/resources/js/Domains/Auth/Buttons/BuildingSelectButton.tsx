import React, { useState } from 'react';
import {
    Button,
    Divider,
    ListItemIcon,
    ListItemText,
    Menu,
    MenuItem,
    Stack,
    Typography
} from '@mui/material';
import { ChangeCircleOutlined, FactoryOutlined, LogoutOutlined, WarehouseOutlined } from '@mui/icons-material';
import { useAuth } from '@/Providers/AuthProvider';
import { useLanguage } from '@/Providers/LanguageProvider';
import { BuildingService } from '@/Services/Auth/BuildingService';

export default function BuildingSelectButton() {
    const { lang } = useLanguage();
    const { building, setBuilding } = useAuth();
    const buildingService = new BuildingService();

    const [buildingMenuEl, setBuildingMenuEl] = useState<EventTarget & HTMLElement | null>(null);
    const openBuildingMenu = Boolean(buildingMenuEl);

    const handleBuildingButtonClick = (e: React.MouseEvent<HTMLElement>) => {
        setBuildingMenuEl(e.currentTarget);
    }

    const handleBuildingMenuClose = () => {
        setBuildingMenuEl(null);
    };

    const handleBuildingChange = async (building_id: number) => {
        console.log(building_id);

        const response = await buildingService.setSessionBuilding(building_id);

        if ( !response ) return;

        setBuilding(response);

        handleBuildingMenuClose();
    }

    const {
        building_name,
        type_name
    } = building?.computed || {};

    const currentBuildingId = building?.attributes.id;

    return (
        <>
            <Button
                onClick={handleBuildingButtonClick}
                startIcon={
                    type_name == 'factory'
                        ? <FactoryOutlined />
                        : <WarehouseOutlined />
                }
                sx={{
                    color: 'text.primary',
                }}
            >
                <Typography
                      variant="subtitle2"
                    sx={{
                        fontWeight: 400,
                        textTransform: 'none',
                    }}
                >
                    {building_name}
                </Typography>
            </Button>

            <Menu
                anchorEl={buildingMenuEl}
                open={openBuildingMenu}
                onClose={handleBuildingMenuClose}
                anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'right',
                }}
                transformOrigin={{
                    vertical: 'top',
                    horizontal: 'right',
                }}
                sx={{
                    '& .MuiPaper-root': {
                        minWidth: 200,
                    }
                }}
            >
                <Stack
                    direction="row"
                    alignItems="center"
                    spacing={2}
                    sx={{
                        px: 3,
                        py: 1.5
                    }}
                >
                    <ChangeCircleOutlined color="primary" />

                    <Typography variant="subtitle1" color="primary" fontWeight={500}>
                        {lang.change_building}
                    </Typography>
                </Stack>

                <Divider />

                <MenuItem
                    onClick={() => handleBuildingChange(1)}
                    selected={currentBuildingId === 1}
                    sx={{ mt: 1 }}
                >
                    <ListItemIcon>
                        <FactoryOutlined />
                    </ListItemIcon>
                    <ListItemText>
                        {lang.plant_2}
                    </ListItemText>
                </MenuItem>

                <Divider />

                <MenuItem
                    onClick={() => handleBuildingChange(2)}
                    selected={currentBuildingId === 2}
                    sx={{ mt: 1 }}
                >
                    <ListItemIcon>
                        <FactoryOutlined />
                    </ListItemIcon>
                    <ListItemText>
                        {lang.blackhawk}
                    </ListItemText>
                </MenuItem>

                <Divider />

                <MenuItem
                    onClick={() => handleBuildingChange(3)}
                    selected={currentBuildingId === 3}
                    sx={{ mt: 1 }}
                >
                    <ListItemIcon>
                        <WarehouseOutlined />
                    </ListItemIcon>
                    <ListItemText>
                        {lang.defiance}
                    </ListItemText>
                </MenuItem>
            </Menu>
        </>
    );
}