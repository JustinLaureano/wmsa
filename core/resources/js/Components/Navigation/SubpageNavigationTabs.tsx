import React from 'react';
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
    onChange: (event: React.SyntheticEvent, newValue: number) => void;
}

export default function SubpageNavigationTabs({ tabs, value, onChange } : SubpageNavigationTabsProps) {

    return (
        <StyledTabsContainer>
            <StyledTabs value={value} onChange={onChange}>
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
