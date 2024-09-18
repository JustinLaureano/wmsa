import { styled } from '@mui/material/styles';
import { Tabs } from '@mui/material';
import { grey } from '@mui/material/colors';

const StyledTabs = styled((props: any) => (
    <Tabs
        {...props}
        TabIndicatorProps={{ children: <span className="MuiTabs-indicatorSpan" /> }}
    />
))(
    ({ theme }) => ({
        // borderBottom: '1px solid #e8e8e8',
        ...(
            theme.palette.mode == 'dark' && {
                borderColor: grey[800]
            }
        ),
        '& .MuiTabs-indicator': {
            display: 'flex',
            justifyContent: 'center',
            // backgroundColor: 'transparent',
        },
        '& .MuiTabs-indicatorSpan': {
            width: '100%',
            // backgroundColor: '#1890ff',
            borderRadius: 8,
            height: '10px'
        },

    })
);

export default StyledTabs;
