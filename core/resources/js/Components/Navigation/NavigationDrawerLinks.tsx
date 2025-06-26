import { useLanguage } from '@/Providers/LanguageProvider';
import { getNavigationDrawerLinks } from './links';
import StyledNavList from '@/Components/Styled/StyledNavList';
import NavigationDrawerLink from './NavigationDrawerLink';

export default function NavigationDrawerLinks() {
    const { lang } = useLanguage();

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
