import NavigationDrawerLinks from './NavigationDrawerLinks';
import StyledNavDrawer from '../Styled/StyledNavDrawer';
import OverflowScrollBox from '../Shared/OverflowScrollBox';

export default function NavigationDrawer() {
	return (
        <StyledNavDrawer>
            <OverflowScrollBox>
                <NavigationDrawerLinks />
            </OverflowScrollBox>
        </StyledNavDrawer>
	);
}
