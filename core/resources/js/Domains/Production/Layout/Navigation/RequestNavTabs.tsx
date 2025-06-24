import React, { useContext, useState } from 'react';
import { NavigationTab, JsonObject } from '@/types';
import { router } from '@inertiajs/react';
import {
    Box,
    Tabs,
    Tab,
} from '@mui/material';
import LanguageContext from '@/Contexts/LanguageContext';

const getTabs = (lang: JsonObject) : NavigationTab[] => {
    return [
        { label: lang.plant_2, route: route('production.requests', { building_id: 1, type: 'transfer' }) },
        { label: lang.blackhawk, route: route('production.requests', { building_id: 2, type: 'transfer' }) },
        { label: lang.defiance, route: route('production.requests', { building_id: 3, type: 'transfer' }) },
        { label: lang.phosphate, route: route('production.requests', { building_id: 1, type: 'phosphate' }) },
        { label: lang.shipping, route: route('production.requests', { building_id: 2, type: 'shipping' }) },
    ]
}

export default function RequestNavTabs() {
    const { lang } = useContext(LanguageContext);

    const href = window.location.href;

    let initialValue = 0;

    const tabs = getTabs(lang);

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
