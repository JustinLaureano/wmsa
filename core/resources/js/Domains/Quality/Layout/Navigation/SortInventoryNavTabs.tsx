import React, { useState } from 'react';
import { NavigationTab } from '@/types';
import { router } from '@inertiajs/react';
import {
    Box,
    Tabs,
    Tab,
} from '@mui/material';

const tabs : NavigationTab[] = [
    { label: 'Plant 2', route: route('quality.sort.inventory', { storage_location_building_id: 1 }) },
    { label: 'Blackhawk', route: route('quality.sort.inventory', { storage_location_building_id: 2 }) },
]

export default function SortInventoryNavTabs() {
    const href = window.location.href;

    let initialValue = 0;

    tabs.map((tab, index) => {
        if (href == tab.route) {
            initialValue = index;
        }
    })

    const [value, setValue] = useState(initialValue);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };

    return (
        <Box sx={{ borderBottom: 1, borderColor: 'divider', mb: 4 }}>
            <Tabs
                sx={{
                    '& .MuiTabs-flexContainer': {
                        justifyContent: 'center',
                    }
                }}
                value={value}
                onChange={handleChange}
            >
                { tabs.map((tab : NavigationTab, index) => (
                    <Tab
                        key={index}
                        label={tab.label}
                        onClick={() => router.get(tab.route)}
                    />
                )) }
            </Tabs>
        </Box>
    )
}
