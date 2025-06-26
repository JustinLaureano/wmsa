import React, { useState } from 'react';
import StyledTabs from '@/Components/Styled/StyledTabs';
import StyledTab from '@/Components/Styled/StyledTab';
import StyledTabsContainer from './Styled/StyledTabsContainer';
import { JsonObject } from '@/types';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function HomeTabs(props : JsonObject) {
    const { lang } = useLanguage();

    const [value, setValue] = useState(0);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
      setValue(newValue);
    };

    return (
        <StyledTabsContainer>
            <StyledTabs value={value} onChange={handleChange}>
                <StyledTab label={lang.overview} onClick={() => {}}></StyledTab>
                <StyledTab label={lang.reports} onClick={() => {}}></StyledTab>
                <StyledTab label={lang.analytics} onClick={() => {}}></StyledTab>
            </StyledTabs>
        </StyledTabsContainer>
    )
}
