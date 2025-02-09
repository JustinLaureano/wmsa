import React, { useContext, useEffect } from 'react';
import {
    Drawer,
    useMediaQuery,
    useTheme
} from '@mui/material';
import UIContext from '@/Contexts/UIContext';
import dimensions from '@/Theme/dimensions';
import { darkMode } from '@/Theme/colors';

interface StyledNavDrawerProps {
    children: React.ReactNode;
}

export default function StyledNavDrawer({ children, ...props } : StyledNavDrawerProps) {
	const theme = useTheme();
	const isDesktop = useMediaQuery(theme.breakpoints.up('md'));
	const { navigationDrawerOpen, setNavigationDrawerOpen } = useContext(UIContext);

	const drawerWidth = navigationDrawerOpen
		? theme.layouts.dashboard.drawerWidth
		: theme.layouts.dashboard.drawerRailWidth;

	const handleDrawerToggle = (e: React.MouseEvent<HTMLElement>) => {
		if (isDesktop) return;

		setNavigationDrawerOpen(false);
	}

	useEffect(() => {
		if (!isDesktop && navigationDrawerOpen) {
			setNavigationDrawerOpen(false);
		}
	}, [isDesktop])

    return (
		<Drawer
			variant={isDesktop ? 'permanent' : 'temporary'}
			open={navigationDrawerOpen}
			onClose={handleDrawerToggle}
			elevation={0}
			sx={{
				[theme.breakpoints.up('md')]: {
					width: `calc(${drawerWidth} + ${theme.spacing(2)})`,
				},
				flexShrink: 0,
				transition: theme.transitions.create('width', {
					easing: theme.transitions.easing.easeOut,
					duration: theme.transitions.duration.standard,
				}),
				[`& .MuiDrawer-paper`]: {
					borderRight: `1px solid ${theme.palette.divider}`,
					...(theme.palette.mode === 'dark' && {
						backgroundColor: darkMode.background,
						borderRight: `1px solid ${theme.palette.divider}`,
					}),
					boxSizing: 'border-box',
					transition: theme.transitions.create('width', {
						easing: theme.transitions.easing.easeOut,
						duration: theme.transitions.duration.standard,
					}),
					width: drawerWidth,
					[theme.breakpoints.up('md')]: {
						height: `calc(100vh - ${dimensions.topAppBarHeight} - ${dimensions.bottomAppBarHeight} - 1px)`,
						marginTop: `calc(${dimensions.topAppBarHeight} + 1px)`,
					}
				},
			}}
            {...props}
		>
            {children}
		</Drawer>
    )
}
