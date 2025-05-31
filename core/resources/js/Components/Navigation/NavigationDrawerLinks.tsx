import StyledNavList from '@/Components/Styled/StyledNavList';
import NavigationDrawerLink from './NavigationDrawerLink';
import { navigationDrawerLinks } from './links';

export default function NavigationDrawerLinks() {
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
