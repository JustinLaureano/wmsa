import React from 'react';
import { router } from '@inertiajs/react';
import { useTheme } from '@mui/material';
import { NavigationDrawerLinkProps } from '@/types';
import {
    ListItem,
    ListItemButton,
	ListItemIcon,
    ListItemText,
    Typography
} from '@mui/material';
import DrawerItemWrapper from './DrawerItemWrapper';

export default function NavigationDrawerLink({ link, index } : NavigationDrawerLinkProps) {
    const theme = useTheme();

    let selected = link.selected.some(route => window.location.href == route);

    // Handles home route
    if (window.location.origin == link.route && window.location.pathname == '/') {
        selected = true;
    }

    const iconColor = selected ? theme.palette.primary.light : theme.palette.text.primary;

    const textColor = selected ?
        theme.palette.mode == 'light' ? theme.palette.primary.main : theme.palette.text.primary
        : theme.palette.text.primary;

	return (
        <DrawerItemWrapper
            link={link}
            key={index}
        >
            <ListItem disablePadding >
                <ListItemButton
                    selected={selected}
                    onClick={() => router.get(link.route)}
                >
                    <ListItemIcon
                        sx={{ color: iconColor }}
                    >
                        <link.icon />
                    </ListItemIcon>

                    <ListItemText
                        primary={
                            <React.Fragment>
                                <Typography
                                    variant="body2"
                                    sx={{ color: textColor }}
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
