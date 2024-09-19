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
    value: number;
}

export default function SubpageNavigationTabs({ tabs, value } : SubpageNavigationTabsProps) {

    return (
        <StyledTabsContainer>
            <StyledTabs value={value}>
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
