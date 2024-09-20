import NavigationDrawerLinks from './NavigationDrawerLinks';
import StyledNavDrawer from '../Styled/StyledNavDrawer';
import OverflowScrollBox from '../Shared/OverflowScrollBox';

interface NavigationDrawerProps {}

export default function NavigationDrawer(props: NavigationDrawerProps) {
	return (
        <StyledNavDrawer>
            <OverflowScrollBox>
                <NavigationDrawerLinks />
            </OverflowScrollBox>
        </StyledNavDrawer>
	);
}
