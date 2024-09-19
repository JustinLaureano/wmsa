import { styled } from '@mui/material/styles';
import { Tabs } from '@mui/material';

const StyledTabs = styled((props: any) => (
    <Tabs
        {...props}
        TabIndicatorProps={{
            children: <span className="MuiTabs-indicatorSpan" />
        }}
    />
))(
    ({ theme }) => ({
        '& .MuiTabs-indicator': {
            display: 'flex',
            justifyContent: 'center',
        },
        '& .MuiTabs-indicatorSpan': {
            width: '100%',
            borderRadius: 8,
            height: '10px'
        }
    })
);

export default StyledTabs;
