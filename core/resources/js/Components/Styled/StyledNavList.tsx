import { styled } from '@mui/material/styles';
import { List } from "@mui/material";

const StyledNavList = styled(List)({
	'& .MuiListItemIcon-root': {
	  minWidth: 0,
	  marginRight: 18,
	},

	'& .MuiSvgIcon-root': {
		fontSize: 20,
	  },
});

export default StyledNavList;
