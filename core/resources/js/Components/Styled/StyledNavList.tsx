import { ReactNode } from 'react';
import { styled } from '@mui/material/styles';
import { List } from "@mui/material";

const StyledNavList = styled((props: { children: ReactNode }) => <List component="nav" {...props} />)({
	'& .MuiListItemIcon-root': {
	  minWidth: 0,
	  marginRight: 18,
	},

	'& .MuiSvgIcon-root': {
		fontSize: 20,
	  },
});

export default StyledNavList;
