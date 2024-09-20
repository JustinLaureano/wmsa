import React, { useState } from 'react';
import StyledTabs from '@/Components/Styled/StyledTabs';
import StyledTab from '@/Components/Styled/StyledTab';
import StyledTabsContainer from '@/Components/Styled/StyledTabsContainer';
import { router } from '@inertiajs/react';

interface TabInterface {
    label: string;
    route: string;
}

interface SubpageNavigationTabsProps {
    tabs: TabInterface[];
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
            <StyledTabs value={value} onChange={handleChange}>
                { tabs.map((tab : TabInterface, index) => (
                    <StyledTab
                        key={index}
                        label={tab.label}
                        onClick={() => router.get(tab.route)}
                    />
                )) }
            </StyledTabs>
        </StyledTabsContainer>
    )
}
