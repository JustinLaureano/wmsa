import { styled } from '@mui/material/styles';
import { Tab } from '@mui/material';

interface StyledTabProps {
    label: string;
    onClick: () => void;
}

const StyledTab = styled((props: StyledTabProps) => <Tab disableRipple {...props} />)(
    ({ theme }) => ({
        textTransform: 'none',
        minWidth: 0,
        fontWeight: theme.typography.fontWeightRegular,
        marginRight: theme.spacing(1),
        '&:hover': {
            // color: '#40a9ff',
            opacity: 1,
        },
        '&.Mui-selected': {
            // color: '#1890ff',
            fontWeight: theme.typography.fontWeightMedium,
        },
        '&.Mui-focusVisible': {
            // backgroundColor: '#d1eaff',
        },
    }),
);

export default StyledTab;
