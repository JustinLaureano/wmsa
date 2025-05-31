import React, { useState } from 'react';
import StyledTabs from '@/Components/Styled/StyledTabs';
import StyledTab from '@/Components/Styled/StyledTab';
import StyledTabsContainer from './Styled/StyledTabsContainer';
import { JsonObject } from '@/types';

export default function HomeTabs(props : JsonObject) {
    const [value, setValue] = useState(0);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
      setValue(newValue);
    };

    return (
        <StyledTabsContainer>
            <StyledTabs value={value} onChange={handleChange}>
                <StyledTab label="Overview"></StyledTab>
                <StyledTab label="Reports"></StyledTab>
                <StyledTab label="Analytics"></StyledTab>
            </StyledTabs>
        </StyledTabsContainer>
    )
}
