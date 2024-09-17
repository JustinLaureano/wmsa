import React from 'react';
import { styled } from '@mui/material/styles';
import { Box, Tab, Tabs } from '@mui/material';
import { grey } from '@mui/material/colors';

interface StyledTabProps {
    label: string;
  }

const StyledTabs = styled(Tabs)(
    ({ theme }) => ({
        borderBottom: '1px solid #e8e8e8',
        ...(
            theme.palette.mode == 'dark' && {
                borderColor: grey[800]
            }
        ),
        '& .MuiTabs-indicator': {
            backgroundColor: '#1890ff',
        },
    })
);

const StyledTab = styled((props: StyledTabProps) => <Tab disableRipple {...props} />)(
    ({ theme }) => ({
        textTransform: 'none',
        minWidth: 0,
        fontWeight: theme.typography.fontWeightRegular,
        marginRight: theme.spacing(1),
        '&:hover': {
            color: '#40a9ff',
            opacity: 1,
        },
        '&.Mui-selected': {
            color: '#1890ff',
            fontWeight: theme.typography.fontWeightMedium,
        },
        '&.Mui-focusVisible': {
            backgroundColor: '#d1eaff',
        },
    }),
);

export default function HomeTabs(props : Record<string, any>) {
    const [value, setValue] = React.useState(0);

    const handleChange = (event: React.SyntheticEvent, newValue: number) => {
      setValue(newValue);
    };

    return (
        <Box>
            <StyledTabs value={value} onChange={handleChange}>
                <StyledTab label="Overview"></StyledTab>
                <StyledTab label="Reports"></StyledTab>
                <StyledTab label="Analytics"></StyledTab>
            </StyledTabs>
        </Box>
    )
}
