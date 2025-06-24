import { useContext } from 'react';
import LanguageContext from '@/Contexts/LanguageContext';
import { getNavigationDrawerLinks } from './links';
import StyledNavList from '@/Components/Styled/StyledNavList';
import NavigationDrawerLink from './NavigationDrawerLink';

export default function NavigationDrawerLinks() {
    const { lang } = useContext(LanguageContext);

    const navigationDrawerLinks = getNavigationDrawerLinks(lang);

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
