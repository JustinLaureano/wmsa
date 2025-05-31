import React, { useState } from 'react';
import { router } from '@inertiajs/react';
import { NavigationTab } from '@/types';
import StyledTabsContainer from '@/Components/Styled/StyledTabsContainer';
import { Tabs, Tab } from '@mui/material';

interface SubpageNavigationTabsProps {
    tabs: NavigationTab[];
}

export default function SubpageNavigationTabs({ tabs } : SubpageNavigationTabsProps) {

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
        <StyledTabsContainer>
            <Tabs value={value} onChange={handleChange}>
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
