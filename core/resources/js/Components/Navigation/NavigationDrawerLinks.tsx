import StyledNavList from '@/Components/Styled/StyledNavList';
import NavigationDrawerLink from './NavigationDrawerLink';
import { navigationDrawerLinks } from './links';

interface NavigationDrawerLinksProps {}

export default function NavigationDrawerLinks(props: NavigationDrawerLinksProps) {
	return (
        <StyledNavList>
            {navigationDrawerLinks.map((link, index) => (
                <NavigationDrawerLink
                    key={index}
                    link={link}
                    index={index}
                />
            ))}
        </StyledNavList>
	);
}
