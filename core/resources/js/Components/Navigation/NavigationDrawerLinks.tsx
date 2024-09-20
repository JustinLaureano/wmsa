import React from 'react';
import { router } from '@inertiajs/react';
import {
    ListItem, ListItemButton,
	ListItemIcon, ListItemText, Typography
} from '@mui/material';
import StyledNavList from '@/Components/Styled/StyledNavList';
import { navigationDrawerLinks } from './links';
import DrawerItemWrapper from './DrawerItemWrapper';

interface NavigationDrawerLinksProps {}

export default function NavigationDrawerLinks(props: NavigationDrawerLinksProps) {

	return (
        <StyledNavList component="nav">
            {navigationDrawerLinks.map((link, index) => (
                <DrawerItemWrapper
                    link={link}
                    key={index}
                >
                    <ListItem disablePadding >
                        <ListItemButton onClick={() => router.get(link.route)}>
                            <ListItemIcon>
                                <link.icon />
                            </ListItemIcon>
                            <ListItemText
                                primary={
                                    <React.Fragment>
                                        <Typography
                                            component="span"
                                            variant="body2"
                                        >
                                            {link.label}
                                        </Typography>

                                    </React.Fragment>
                                }
                            />
                        </ListItemButton>
                    </ListItem>
                </DrawerItemWrapper>
            ))}
        </StyledNavList>
	);
}
