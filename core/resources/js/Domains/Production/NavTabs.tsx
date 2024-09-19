import React, { useState } from 'react';
import StyledTabs from '@/Components/Styled/StyledTabs';
import StyledTab from '@/Components/Styled/StyledTab';
import StyledTabsContainer from '@/Components/Styled/StyledTabsContainer';

export default function NavTabs(props : Record<string, any>) {
    const [value, setValue] = useState(0);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };

    return (
        <StyledTabsContainer>
            <StyledTabs value={value} onChange={handleChange}>
                <StyledTab label="Material Requests"></StyledTab>
                <StyledTab label="New Request"></StyledTab>
                <StyledTab label="Stock Transfer"></StyledTab>
            </StyledTabs>
        </StyledTabsContainer>
    )
}
