import React from 'react';
import { router } from '@inertiajs/react';
import {
    ListItem,
    ListItemButton,
	ListItemIcon,
    ListItemText,
    Typography
} from '@mui/material';
import { Link } from './links';
import DrawerItemWrapper from './DrawerItemWrapper';

interface NavigationDrawerLinkProps {
    link: Link;
    index: number;
}

export default function NavigationDrawerLink({ link, index } : NavigationDrawerLinkProps) {

	return (
        <DrawerItemWrapper
            link={link}
            key={index}
        >
            <ListItem disablePadding >
                <ListItemButton
                    selected={window.location.href == link.route}
                    onClick={() => router.get(link.route)}
                >
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
	);
}
