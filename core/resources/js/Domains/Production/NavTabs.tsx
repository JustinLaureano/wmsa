import React from 'react';
import { Box } from '@mui/material';
import StyledTabs from '@/Components/Styled/StyledTabs';
import StyledTab from '@/Components/Styled/StyledTab';

export default function NavTabs(props : Record<string, any>) {
    const [value, setValue] = React.useState(0);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
        setValue(newValue);
    };

    return (
        <Box>
            <StyledTabs value={value} onChange={handleChange}>
                <StyledTab label="Material Requests"></StyledTab>
                <StyledTab label="New Request"></StyledTab>
                <StyledTab label="Stock Transfer"></StyledTab>
            </StyledTabs>
        </Box>
    )
}
