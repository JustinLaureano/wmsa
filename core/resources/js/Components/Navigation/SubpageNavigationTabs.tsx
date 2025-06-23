import React, { useState } from 'react';
import { router } from '@inertiajs/react';
import { NavigationTab, SubpageNavigationTabsProps } from '@/types';
import StyledTabsContainer from '@/Components/Styled/StyledTabsContainer';
import { Tabs, Tab } from '@mui/material';

export default function SubpageNavigationTabs({ tabs, centered = false, sx = {} } : SubpageNavigationTabsProps) {
    const href = window.location.href;

    let initialValue = 0;

    tabs.map((tab, index) => {
        if (tab.selected?.some(route => href == route)) {
            initialValue = index;
        }
    })

    const [value, setValue] = useState(initialValue);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };

    return (
        <StyledTabsContainer sx={{ ...sx }}>
            <Tabs
                sx={centered ? {
                    '& .MuiTabs-flexContainer': {
                        justifyContent: 'center',
                    },
                } : {}}
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
        </StyledTabsContainer>
    )
}
